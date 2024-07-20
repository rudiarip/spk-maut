(function(factory) {
    /* global define */
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as an anonymous module.
        define(['jquery'], factory);
    } else if (typeof module === 'object' && module.exports) {
        // Node/CommonJS
        module.exports = factory(require('jquery'));
    } else {
        // Browser globals
        factory(window.jQuery);
    }
}(function($) {

    /**
     * @class plugin.macro-dropdown
     *
     * Initialize in the toolbar like so:
     *   toolbar: ['insert', ['macroList']]
     *
     * Ultimus Custom Macro Plugin
     */
    $.extend($.summernote.plugins, {
        /**
         * @param {Object} context - context object has status of editor.
         */
        'macroList': function(context) {
            var self = this;

            var options = context.options.macroList;
            var defaultOptions = {
              label: "Macro",
              tooltip: "Insert Macro",
              blockChar : '%',
            };
      
            // Assign default values if not supplied
            for (var propertyName in defaultOptions) {
              if (options.hasOwnProperty(propertyName) === false) {
                options[propertyName] = defaultOptions[propertyName];
              }
            }
            
            // ui has renders to build ui elements.
            //  - you can create a button with `ui.button`
            var ui = $.summernote.ui;

            // add macro toolbar button
            context.memo('button.macroList', function() {
                var list = "";

                var macroButton = ui.buttonGroup([
                    ui.button({
                        className: 'dropdown-toggle',
                        contents: '<span class="template"/> ' + options.label + ' <span class="caret"></span>',
                        tooltip: options.tooltip,
                        data: {
                            toggle: 'dropdown'
                        },
                        click: function () {
                            console.log('macro button click');
                            context.invoke('editor.saveRange');
                        }
                    }),
                    ui.dropdown({
                        className: 'dropdown-style',
                        items: options.items,
                        //contents: list,
                        callback: function($dropdown) {
                          console.log('$dropdown callback');
                          /*
                            $dropdown.find('i').each(function() {
                                $(this).click(function() {
                                    addimg($(this).attr("class"));
                                });
                            });
                            */
                        },
                        click: function (event) {
                          event.preventDefault();
                          
                          var $button = $(event.target);
                          var value   = $button.data('value');
                          var text = options.blockChar + value + options.blockChar;
                          context.invoke('editor.insertText', text);
                          
                          console.log('$dropdown click : ' + options.blockChar + value + options.blockChar);
                        },
                        template: function(item)
                        {
                          var content = (typeof item === 'string') ? item : (item.content || item.value || '');
                          return content;
                        }
                    })
                ]).render();
                return macroButton;
            });

            // This events will be attached when editor is initialized.
            this.events = {
                // This will be called after modules are initialized.
                'summernote.init': function(we, e) {

                    //console.log('summernote initialized', we, e);
                },
                // This will be called when user releases a key on editable.
                'summernote.keyup': function(we, e) {

                    //console.log('summernote keyup', we, e);
                }
            };

            // This methods will be called when editor is destroyed by $('..').summernote('destroy');
            // You should remove elements on `initialize`.
            this.destroy = function() {

            };

            function addimg(value) {
                var img = $('<iframe frameborder="0" class="' + value + '"></iframe>');
                context.invoke('editor.restoreRange');
                context.invoke('editor.focus');
                context.invoke("editor.insertNode", img[0]);
            }
        }
    });

}));