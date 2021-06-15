<?php


namespace app\components\renderers;


use unclead\multipleinput\components\BaseColumn;
use unclead\multipleinput\renderers\ListRenderer as BaseListRenderer;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class ListRenderer extends BaseListRenderer {


    /**
     * Renders the header.
     *
     * @return string
     */
    public function renderHeader() {
        if ($this->min !== 0 || !$this->isAddButtonPositionHeader()) {
            return '';
        }

        $button = $this->isAddButtonPositionHeader() ? $this->renderAddButton() : '';

        $content = [];
        $content[] = Html::tag('td', '&nbsp;');

        if ($this->cloneButton) {
            $content[] = Html::tag('td', '&nbsp;');
        }

        $content[] = Html::tag('td', $button, [
            'class' => 'list-cell__button',
        ]);

        return Html::tag('thead', Html::tag('tr', implode("\n", $content)));
    }

    /**
     * Renders the cell content.
     *
     * @param BaseColumn $column
     * @param int|null $index
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function renderCellContent($column, $index, $columnIndex = null) {
        $id = $column->getElementId($index);
        $name = $column->getElementName($index);

        /**
         * This class inherits iconMap from BaseRenderer
         * If the input to be rendered is a drag column, we give it the appropriate icon class
         * via the $options array
         */
        $options = ['id' => $id];
        if (substr($id, -4) === 'drag') {
            $options = ArrayHelper::merge($options, ['class' => $this->iconMap['drag-handle']]);
        }

        $input = $column->renderInput($name, $options, [
            'id' => $id,
            'name' => $name,
            'indexPlaceholder' => $this->getIndexPlaceholder(),
            'index' => $index,
            'columnIndex' => $columnIndex,
            'context' => $this->context,
        ]);

        if ($column->isHiddenInput()) {
            return $input;
        }

        $layoutConfig = array_merge([
            'offsetClass' => $this->isBootstrapTheme() ? 'col-sm-offset-3' : '',
            'labelClass' => $this->isBootstrapTheme() ? 'col-sm-3' : '',
            'wrapperClass' => $this->isBootstrapTheme() ? 'col-sm-6' : '',
            'errorClass' => $this->isBootstrapTheme() ? 'col-sm-offset-3 col-sm-6' : '',
        ], $this->layoutConfig);

        Html::addCssClass($column->errorOptions, $layoutConfig['errorClass']);

        $hasError = false;
        $error = '';

        if ($index !== null) {
            $error = $column->getFirstError($index);
            $hasError = !empty($error);
        }

        $wrapperOptions = [];

        if ($hasError) {
            Html::addCssClass($wrapperOptions, 'has-error');
        }

        Html::addCssClass($wrapperOptions, $layoutConfig['wrapperClass']);

        $options = [
            'class' => "field-$id list-cell__$column->name" . ($hasError ? ' has-error' : '')
        ];

        if ($this->isBootstrapTheme()) {
            Html::addCssClass($options, 'form-group row');
        }

        if (is_callable($column->columnOptions)) {
            $columnOptions = call_user_func($column->columnOptions, $column->getModel(), $index, $this->context);
        } else {
            $columnOptions = $column->columnOptions;
        }

        $options = array_merge_recursive($options, $columnOptions);

        $content = Html::beginTag('div', $options);

        if (empty($column->title)) {
            Html::addCssClass($wrapperOptions, $layoutConfig['offsetClass']);
        } else {
            $labelOptions = ['class' => $layoutConfig['labelClass']];
            if ($this->isBootstrapTheme()) {
                Html::addCssClass($labelOptions, 'control-label');
            }

            $content .= Html::label($column->title, $id, $labelOptions);
        }

        $content .= Html::tag('div', $input, $wrapperOptions);

        if ($column->enableError) {
            $content .= "\n" . $column->renderError($error);
        }

        $content .= Html::endTag('div');

        return $content;
    }

    /**
     * Renders the footer.
     *
     * @return string
     */
    public function renderFooter() {
        if (!$this->isAddButtonPositionFooter()) {
            return '';
        }

        $cells = [];
        $cells[] = Html::tag('td', '&nbsp;');
        $cells[] = Html::tag('td', $this->renderAddButton(), [
            'class' => 'list-cell__button',
            'colspan' => '2'
        ]);

        return Html::tag('tfoot', Html::tag('tr', implode("\n", $cells)));
    }

    private function renderAddButton() {
        $options = [
            'class' => 'multiple-input-list__btn js-input-plus',
        ];
        Html::addCssClass($options, $this->addButtonOptions['class']);

        return Html::tag('div', $this->addButtonOptions['label'], $options);
    }
}