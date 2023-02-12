
(function (window) {
	'use strict'
	function PluginCurrency() {

        var Plugin_currency = {};

        Plugin_currency.toCurrencyFormat = function (curr_code, amount) {
			const currencyFormat = new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: curr_code
            });
        
            return currencyFormat.format(amount);
		};

        Plugin_currency.convert = function (curr_from, curr_to, amount) {

        }
        return Plugin_currency;
	};

	if(typeof(Plugin_currency) === 'undefined'){
		window.Plugin_currency = PluginCurrency();
	}
}) (window);
