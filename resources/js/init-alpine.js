const appAlpine = {
    selectedCompany: new URLSearchParams(location.search).get('company'),
    loading:true,
    company: false,
    getThemeFromLocalStorage() {
        // if user already changed the theme, use it
        if (window.localStorage.getItem("dark")) {
            return JSON.parse(window.localStorage.getItem("dark"));
        }
        // else return their preferences
        return (
            !!window.matchMedia &&
            window.matchMedia("(prefers-color-scheme: dark)").matches
        );
    },
    setThemeToLocalStorage: (value) => {
        window.localStorage.setItem("dark", value);
    },
    getMobile() {
        return window.innerWidth <= 640;
    },
    setMobile() {
        this.mobile = this.getMobile();
    },
    mobile: false,
    openSideBar: false,
    dark: false,
    toggleTheme: {
        ["@click"]() {
            this.dark = !this.dark;
            this.setThemeToLocalStorage(this.dark);
        },
    },
    init() {
        this.dark = this.getThemeFromLocalStorage();
        this.mobile = this.getMobile();
        if (this.selectedCompany > 4) {
            this.selectedCompany = null;
            const url = new URL(window.location.href);
            url.searchParams.delete('company');
            history.pushState(null, document.title, url.toString());
        }
        this.$watch('selectedCompany', (value) => {
            const url = new URL(window.location.href);
            url.searchParams.set('company', value);
            history.pushState(null, document.title, url.toString());
        });
    },
};

const formAlpine = {
    inputElements: [],
    blurred: true,
    init() {
        //Set up custom Iodine rules
        this.customValidations();
        //Store an array of all the input elements with 'data-rules' attributes
        this.inputElements = [
            ...this.$el.querySelectorAll(
                "input[data-rules],select[data-rules],textarea[data-rules]"
            ),
        ];
        this.initDomData();
        this.updateErrorMessages();

        if (typeof Livewire !== "undefined") {
            Livewire.on("saved", () => {
                this.$el.querySelectorAll("select").forEach((element) => {
                    element.dispatchEvent(new Event("change"));
                });
            });
        }
    },
    customValidations() {
        //Set up custom Iodine rules
        Iodine.rule(
            "matchingPassword",
            (value) => value === document.getElementById("password").value
        );
        const matchingPassMsg = "Password confirmation needs to match password";
        Iodine.messages.matchingPassword = langs[locale][matchingPassMsg]
            ? langs[locale][matchingPassMsg]
            : matchingPassMsg;

        Iodine.rule("walletFormat", (value) =>
            walletValidation(document.getElementById("currency").value, value)
        );
        const walletFormatMsg = "The wallet is incorrectly formatted";
        Iodine.messages.walletFormat = langs[locale][walletFormatMsg]
            ? langs[locale][walletFormatMsg]
            : walletFormatMsg;

        Iodine.rule("requiredIf", (value, param) => {
            let validateOptions = param.split(",");
            let ifValidateEl = document.getElementById(validateOptions[0]);
            let validation = true;
            let ifValidateValue =
                ifValidateEl?.getAttribute("type") == "checkbox"
                    ? String(ifValidateEl.checked)
                    : ifValidateEl.value;
            if (ifValidateEl) {
                switch (validateOptions[1]) {
                    case "==":
                        validation = ifValidateValue == validateOptions[2];
                        break;
                    case "===":
                        validation = ifValidateValue === validateOptions[2];
                        break;
                    case "!=":
                        validation = ifValidateValue != validateOptions[2];
                        break;
                    case "!==":
                        validation = ifValidateValue !== validateOptions[2];
                        break;
                    case "<":
                        validation = ifValidateValue < validateOptions[2];
                        break;
                    case ">":
                        validation = ifValidateValue > validateOptions[2];
                        break;
                }
            }
            if (validation) {
                return ![null, undefined, ""].includes(value);
            }
            return true;
        });
        const requiredIfMsg = "[FIELD] must be present";
        Iodine.messages.requiredIf = langs[locale].requiredIf
            ? langs[locale].requiredIf
            : requiredIfMsg;
    },
    initDomData: function () {
        //Create an object attached to the component state for each input element to store its state
        this.inputElements.map((ele) => {
            let serverErrors = ele.dataset.serverErrors
                ? ele.dataset.serverErrors.replace(/'/g, '"')
                : "[]";
            if (ele.tagName === "SELECT") {
                let selectParent = ele.parentElement.parentElement;
                serverErrors = selectParent.dataset.serverErrors
                    ? selectParent.dataset.serverErrors.replace(/'/g, '"')
                    : "[]";
            }
            this[ele.name] = {
                errorMessage: "",
                serverErrors: JSON.parse(serverErrors),
                blurred: false,
            };
        });
    },
    updateErrorMessages: function () {
        //map throught the input elements and set the 'errorMessage'
        this.inputElements.map((ele) => {
            this[ele.name].errorMessage = this.getErrorMessage(ele);
            if (this.blurred && this[ele.name].errorMessage) {
                this[ele.name].blurred = true;
            }
        });
        this.blurred = false;
    },
    serverValidation: function () {
        this.blurred = true;
        this.initDomData();
        this.updateErrorMessages();
    },
    getErrorMessage: function (ele) {
        //Return any server errors if they're present
        if (this[ele.name].serverErrors.length > 0) {
            return this[ele.name].serverErrors[0];
        }
        //Check using iodine and return the error message only if the element has not been blurred
        let rules = ele.dataset.rules
            ? ele.dataset.rules.replace(/'/g, '"')
            : "[]";
        Iodine.setDefaultFieldName(
            langs[locale][ele.name] ? langs[locale][ele.name] : ele.name
        );
        const error = Iodine.assert(ele.value, JSON.parse(rules));
        if (error.valid !== true && this[ele.name].blurred) {
            let errorMsg = error.error;
            return errorMsg.charAt(0).toUpperCase() + errorMsg.slice(1);
        }
        //return empty string if there are no errors
        return "";
    },
    submit: function (event) {
        const invalidElements = this.getInvalidElements();
        this.$root.addEventListener("submit", (evn) => {
            evn.preventDefault();
            evn.stopPropagation();
        });
        if (invalidElements.length > 0) {
            event.preventDefault();
            let scrollEl = document.getElementById(invalidElements[0].id);
            let y =
                scrollEl.getBoundingClientRect().top + window.pageYOffset + -80;
            window.scrollTo({ top: y, behavior: "smooth" });
            //We set all the inputs as blurred if the form has been submitted
            this.inputElements.map((input) => {
                this[input.name].blurred = true;
            });
            //And update the error messages.
            this.updateErrorMessages();
        } else {
            if (this.$root.hasAttribute("wire:submit.prevent")) {
                runEvent("submit", `#${this.$root.id}`);
            } else {
                this.$root.submit();
            }
        }
    },
    change: function (event) {
        //Ignore all events that aren't coming from the inputs we're watching
        if (!this[event.target.name]) {
            return false;
        }
        if (event.type === "input") {
            this[event.target.name].serverErrors = [];
        }
        if (event.type === "focusout") {
            this[event.target.name].blurred = true;
        }
        //Whether blurred or on input, we update the error messages
        this.updateErrorMessages();
    },
    getInvalidElements: function () {
        return this.inputElements.filter((input) => {
            let rules = input.dataset.rules
                ? input.dataset.rules.replace(/'/g, '"')
                : "[]";
            let error = Iodine.assert(input.value, JSON.parse(rules));
            return error.valid !== true;
        });
    },
    events: {
        ["@focusout"](event) {
            this.change(event);
        },
        ["@input"](event) {
            this.change(event);
        },
        /* ['@submit'](event) {
            this.submit(event)
        } */
    },
};

/* const selectAlpine = (route, text, val, preselect = '', extraPayloadId = '') => ({
    selectInstance: null,
    init() {
        this.selectInstance = new SlimSelect({
            select: `#${this.$refs.select.id}`,
            settings: {
                placeholderText: langs[locale]["Select an option"],
                searchText: langs[locale]["Start typing to search"],
                searchPlaceholder: langs[locale]["Search"],
                searchingText: langs[locale]["Searching"]+'...',
                searchHighlight: true,
            },
            events: {
                search: async (search, currentData) => {
                    return new Promise((resolve, reject) => {
                        // Fetch random first and last name data
                        let payload = {
                            search: search,
                            byId: preselect
                        };
                        if (extraPayloadId) {
                            payload[extraPayloadId] = document.getElementById(extraPayloadId).value
                        }
                        axios
                            .get(route, { params: payload })
                            .then((resp) => {
                                const options = resp.data
                                    .filter((item) => {
                                        return !currentData.some(
                                            (optionItem) => {
                                                return (
                                                    optionItem.value ==
                                                    item.value
                                                );
                                            }
                                        );
                                    })
                                    .map((item) => {
                                        return {
                                            text: item[text],
                                            value: item[val],
                                        };
                                    });
                                resolve(options);
                            })
                            .catch(e => {
                                console.log(e);
                                reject(e);
                            });
                    });
                },
            },
        });
        setTimeout(() => {
            this.selectInstance.search(preselect ?? '')
        }, extraPayloadId ? 2300 : 300);
        if (preselect) {
            setTimeout(() => {
                this.selectInstance.setSelected(preselect)
            }, 1300);
            setTimeout(() => {
                this.selectInstance.search('')
            }, 1300);
        }
    },
}); */

//Alpine is loaded
document.addEventListener("alpine:init", () => {
    if (locale == "es") {
        Iodine.setErrorMessages(validation);
    }
    /**
     * Alpine global app
     */
    Alpine.data("app", () => appAlpine);
    /**
     * Alpine forms validator
     */
    Alpine.data("form", () => formAlpine);
    /**
     * Alpine selects
     */
    // Alpine.data("select", selectAlpine);
});
