<?php 
interface Button {
    public function render();
}

interface Checkbox {
    public function check();
}

class WinButton implements Button {
    public function render() { echo "Windows Button"; }
}

class MacButton implements Button {
    public function render() { echo "Mac Button"; }
}

class WinCheckbox implements Checkbox {
    public function check() { echo "Windows Checkbox"; }
}

class MacCheckbox implements Checkbox {
    public function check() { echo "Mac Checkbox"; }
}

interface GUIFactory {
    public function createButton(): Button;
    public function createCheckbox(): Checkbox;
}

class WinFactory implements GUIFactory {
    public function createButton(): Button {
        return new WinButton();
    }

    public function createCheckbox(): Checkbox {
        return new WinCheckbox();
    }
}

class MacFactory implements GUIFactory {
    public function createButton(): Button {
        return new MacButton();
    }

    public function createCheckbox(): Checkbox {
        return new MacCheckbox();
    }
}

// Usage
function renderUI(GUIFactory $factory) {
    $button = $factory->createButton();
    $checkbox = $factory->createCheckbox();

    $button->render();
    $checkbox->check();
}

$factory = new MacFactory();
renderUI($factory);




?>