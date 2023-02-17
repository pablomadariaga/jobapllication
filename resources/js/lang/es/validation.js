const validation = {
    after         : `La fecha debe ser posterior a: '[PARAM]'`,
    afterOrEqual  : `La fecha debe ser posterior o igual a: '[PARAM]'`,
    array         : `[FIELD] debe ser un array`,
    before        : `La fecha debe ser anterior a: '[PARAM]'`,
    beforeOrEqual : `La fecha debe ser anterior o igual a: '[PARAM]'`,
    boolean       : `[FIELD] debe ser verdadero o falso`,
    date          : `[FIELD] debe ser una fecha`,
    different     : `[FIELD] debe ser diferente a '[PARAM]'`,
    endingWith    : `[FIELD] debe terminar con '[PARAM]'`,
    email         : `[FIELD] debe ser una dirección de correo electrónico válida`,
    falsy         : `[FIELD] debe ser un valor falso (false, 'false', 0 or '0')`,
    in            : `[FIELD] debe ser una de las siguientes opciones: [PARAM]`,
    integer       : `[FIELD] debe ser un entero`,
    json          : `[FIELD] debe ser una cadena de objeto JSON analizable`,
    max           : `[FIELD] debe ser menor o igual que [PARAM]`,
    min           : `[FIELD] debe ser mayor o igual que [PARAM]`,
    maxLength     : `[FIELD] no debe ser mayor que '[PARAM]' en longitud de caracteres`,
    minLength     : `[FIELD] no debe tener una longitud de carácter inferior a '[PARAM]'`,
    notIn         : `[FIELD] no debe ser una de las siguientes opciones: [PARAM]`,
    numeric       : `[FIELD] debe ser numérico`,
    optional      : `[FIELD] es opcional`,
    regexMatch    : `[FIELD] debe satisfacer la expresión regular: [PARAM]`,
    required      : `[FIELD] es obligatorio`,
    same          : `[FIELD] debe ser '[PARAM]'`,
    startingWith  : `[FIELD] debe comenzar con '[PARAM]'`,
    string        : `[FIELD] debe ser una cadena`,
    truthy        : `[FIELD] debe ser un valor verdadero (true, 'true', 1 or '1')`,
    url           : `[FIELD] debe ser una URL válida`,
    uuid          : `[FIELD] debe ser un UUID válido`,
  };
export {validation};
