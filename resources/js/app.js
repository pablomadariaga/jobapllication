// import './bootstrap';
import Alpine from 'alpinejs'
import Iodine from '@caneara/iodine';
import Tooltip from "@ryangjchandler/alpine-tooltip";
import focus from '@alpinejs/focus'
// import SlimSelect from 'slim-select'
import {validation} from './lang/es/validation';
import es from "./lang/es"
import en from "./lang/en"

window.locale = document.documentElement.lang || document.getElementsByTagName("html")[0].getAttribute("lang");
window.langs = {
    es: es,
    en: en
}
window.validation = validation;
window.iodine = new Iodine();
// window.SlimSelect = SlimSelect

/**
 * Debounce function
 * @param {Function} func
 * @param {Number} timeout
 * @returns
 */
window.debounce = (func, timeout = 500) => {
    let timer;
    return (...args) => {
      clearTimeout(timer);
      timer = setTimeout(() => { func.apply(this, args); }, timeout);
    };
}

Alpine.plugin(Tooltip);
Alpine.plugin(focus)
window.Alpine = Alpine;

Alpine.start();
