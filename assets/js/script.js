jQuery(document).ready(function($) {
    $(".wordpress-grid-accordion").on("click", ".grid-accordion-item", function() {
        var $clickedItem = $(this);
        var $currentRow = $clickedItem.closest(".grid-accordion-row");
        var $accordionContainer = $clickedItem.closest(".wordpress-grid-accordion");
        var itemIndex = $currentRow.find(".grid-accordion-item").index($clickedItem);
        var rowIndex = $accordionContainer.find(".grid-accordion-row").index($currentRow);

        // Calcula o índice global do item clicado
        var globalItemIndex = (rowIndex * 3) + itemIndex;

        // Encontra o wrapper de conteúdo para esta linha
        var $contentWrapper = $currentRow.next(".grid-accordion-content-wrapper");

        // Se o item clicado já estiver ativo, fecha-o
        if ($clickedItem.hasClass("active")) {
            $clickedItem.removeClass("active");
            $contentWrapper.slideUp(function() {
                $contentWrapper.empty(); // Limpa o conteúdo quando fecha
            });
        } else {
            // Remove a classe 'active' de todos os outros itens na mesma linha
            $currentRow.find(".grid-accordion-item").removeClass("active");

            // Adiciona a classe 'active' ao item clicado
            $clickedItem.addClass("active");

            // Encontra o conteúdo correspondente nos dados passados pelo PHP
            var contentData = gridAccordionData[globalItemIndex].content;

            // Atualiza e exibe o wrapper de conteúdo
            $contentWrapper.html(contentData).slideDown();
        }
    });
});


