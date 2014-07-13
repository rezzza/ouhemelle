$(window).on('load', function() {
    console.log('> load');

    var textareaEditor = $('.diagram-editor textarea');
    var diagramPreview = $('#diagram-preview');
    var compilationErrorLog = $('.compilation-error');
    /**
     *
     * @param editor jQuery
     * @param preview jQuery
     */
    function previewCallback(editor, preview, compilationErrorLog) {
        var diagram = null;
        var hasError = false;

        try {
            diagram = Diagram.parse(editor.val());
        }
        catch (error) {
            hasError = true;
            compilationErrorLog.text('Error!' + error.message);
        } finally {
            if (!hasError) {
                compilationErrorLog.text('Ok.')
            }
        }

        if (null != diagram) {
            preview.find('svg').remove();
            diagram.drawSVG(preview.attr('id'));
        }
    }

    previewCallback(textareaEditor, diagramPreview, compilationErrorLog);
    textareaEditor.on('change keyup', function() {
        previewCallback(textareaEditor, diagramPreview, compilationErrorLog);
    });
});
