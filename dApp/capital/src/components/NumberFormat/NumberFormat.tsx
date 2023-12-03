/**
 * Capital - Number formated input component
 *
 * @version 1.0.7
 * @author Aleksandr Vorkunov
 */

import React from "react";
import NumberFormat from "react-number-format";

const NumberFormatCustom = (props:any) => {
    const {
        inputRef,
        onChange,
        prefix,
        ...other
    } = props;
    return (
        <NumberFormat
            {...other}
            getInputRef={inputRef}
            onValueChange={(values) => {
                onChange({
                    target: {
                        name: props.name,
                        value: values.value,
                    },
                });
            }}
            thousandSeparator
            isNumericString
        />
    );
};

export default NumberFormatCustom;
