✅ Real-World Use Case: UI Component Tree
Imagine building a UI with:
- Single components (like Button, Label)
- Containers that hold components (Panel, Form).
- You want to call the same method on all of them, like render().

#

**🛠 Composite Pattern in JavaScript**

1. Component Interface

```js
class UIComponent {
  render(indent = 0) {
    throw new Error("Method 'render()' must be implemented.");
  }
}

```

2. Leaf Components (Button, Label)


```js
class Button extends UIComponent {
  constructor(label) {
    super();
    this.label = label;
  }

  render(indent = 0) {
    console.log(' '.repeat(indent) + `<button>${this.label}</button>`);
  }
}

class Label extends UIComponent {
  constructor(text) {
    super();
    this.text = text;
  }

  render(indent = 0) {
    console.log(' '.repeat(indent) + `<label>${this.text}</label>`);
  }
}

```

3. Composite Component (Panel)

```js
class Panel extends UIComponent {
  constructor(name) {
    super();
    this.name = name;
    this.children = [];
  }

  add(component) {
    this.children.push(component);
  }

  render(indent = 0) {
    console.log(' '.repeat(indent) + `<div class="panel">${this.name}`);
    for (const child of this.children) {
      child.render(indent + 2);
    }
    console.log(' '.repeat(indent) + `</div>`);
  }
}

```

4. Usage Example
```js
const loginPanel = new Panel("Login Panel");
loginPanel.add(new Label("Username:"));
loginPanel.add(new Button("Login"));

const mainPanel = new Panel("Main Panel");
mainPanel.add(loginPanel);
mainPanel.add(new Button("Logout"));

mainPanel.render();

```

🖨️ Output
```
<div class="panel">Main Panel
  <div class="panel">Login Panel
    <label>Username:</label>
    <button>Login</button>
  </div>
  <button>Logout</button>
</div>
```

✅ Benefits of the Composite Pattern

| Benefit          | Description                                       |
| ---------------- | ------------------------------------------------- |
| 🧱 Uniformity    | Treat all components the same (leaf or composite) |
| 🔄 Flexibility   | Nest and manage components dynamically            |
| 🔌 Extendability | Add new component types easily                    |


🧩 Real-World JS Use Cases

- React’s virtual DOM (tree of components)
- File explorers (files & folders)
- Menus and dropdowns
- Organization charts
- Drawing tools with grouped shapes

