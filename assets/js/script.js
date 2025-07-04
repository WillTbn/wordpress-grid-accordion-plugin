jQuery(document).ready(function($) {
    // Função para inicializar acordeões
    function initializeAccordion($container) {
        $container.on("click", ".grid-accordion-item", function(e) {
            // Previne cliques no editor do Elementor
            if ($('body').hasClass('elementor-editor-active')) {
                e.preventDefault();
                return;
            }

            var $clickedItem = $(this);
            var $accordionContainer = $clickedItem.closest(".wordpress-grid-accordion");
            var itemId = $clickedItem.data('item-id');
            var $contentWrapper = $accordionContainer.find('.grid-accordion-content-wrapper[data-item-id="' + itemId + '"]');

            // Se o item clicado já estiver ativo, fecha-o
            if ($clickedItem.hasClass("active")) {
                $clickedItem.removeClass("active");
                $contentWrapper.slideUp(300, function() {
                    // Remove o wrapper do DOM após a animação
                    $contentWrapper.remove();
                });
            } else {
                // Fecha todos os outros itens ativos no mesmo acordeão
                $accordionContainer.find(".grid-accordion-item.active").each(function() {
                    var $activeItem = $(this);
                    var activeItemId = $activeItem.data('item-id');
                    var $activeContentWrapper = $accordionContainer.find('.grid-accordion-content-wrapper[data-item-id="' + activeItemId + '"]');
                    
                    $activeItem.removeClass("active");
                    $activeContentWrapper.slideUp(300, function() {
                        $activeContentWrapper.remove();
                    });
                });

                // Ativa o item clicado
                $clickedItem.addClass("active");

                // Cria e insere o wrapper de conteúdo após o item clicado
                var itemIndex = $clickedItem.data('item-index');
                var accordionId = $accordionContainer.attr('id');
                var contentData = '';

                // Busca o conteúdo nos dados do JavaScript
                var dataVarName = 'gridAccordionData_' + accordionId;
                if (typeof window[dataVarName] !== 'undefined' && window[dataVarName][itemIndex]) {
                    contentData = window[dataVarName][itemIndex].content;
                } else {
                    // Fallback
                    contentData = '<p>Conteúdo do item ' + (itemIndex + 1) + '</p>';
                }

                // Cria o wrapper de conteúdo
                var $newContentWrapper = $('<div class="grid-accordion-content-wrapper" data-item-id="' + itemId + '" style="display: none;">' +
                    '<div class="grid-accordion-content">' + contentData + '</div>' +
                    '</div>');

                // Insere o wrapper após o item clicado
                $clickedItem.after($newContentWrapper);

                // Anima a exibição
                $newContentWrapper.slideDown(300);
            }
        });
    }

    // Inicializar acordeões existentes
    $(".wordpress-grid-accordion").each(function() {
        initializeAccordion($(this));
    });

    // Compatibilidade com Elementor - reinicializar quando widgets são adicionados
    if (typeof elementorFrontend !== 'undefined') {
        elementorFrontend.hooks.addAction('frontend/element_ready/grid_accordion.default', function($scope) {
            var $accordion = $scope.find('.wordpress-grid-accordion');
            if ($accordion.length) {
                // Remove event listeners anteriores para evitar duplicação
                $accordion.off('click', '.grid-accordion-item');
                initializeAccordion($accordion);
            }
        });
    }

    // Para widgets adicionados dinamicamente (AJAX, etc.)
    $(document).on('DOMNodeInserted', function(e) {
        var $target = $(e.target);
        if ($target.hasClass('wordpress-grid-accordion') || $target.find('.wordpress-grid-accordion').length) {
            setTimeout(function() {
                $target.find('.wordpress-grid-accordion').each(function() {
                    var $accordion = $(this);
                    if (!$accordion.data('initialized')) {
                        $accordion.off('click', '.grid-accordion-item');
                        initializeAccordion($accordion);
                        $accordion.data('initialized', true);
                    }
                });
            }, 100);
        }
    });
});

