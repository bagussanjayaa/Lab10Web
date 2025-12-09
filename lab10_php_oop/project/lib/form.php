<?php
class Form {
    private $fields = [];
    private $action;
    private $submit;

    public function __construct($action, $submit = "Submit") {
        $this->action = $action;
        $this->submit = $submit;
    }

    public function addField($name, $label, $type = "text", $value = "") {
        $this->fields[] = [
            'name' => $name,
            'label' => $label,
            'type' => $type,
            'value' => $value
        ];
    }

    public function displayForm() {
        echo "<form action='{$this->action}' method='POST' enctype='multipart/form-data'>";
        echo "<table>";
        foreach ($this->fields as $field) {
            echo "<tr><td>{$field['label']}</td>";
            echo "<td><input type='{$field['type']}' name='{$field['name']}' value='{$field['value']}'></td></tr>";
        }
        echo "<tr><td colspan='2'><input type='submit' value='{$this->submit}'></td></tr>";
        echo "</table></form>";
    }
}
?>