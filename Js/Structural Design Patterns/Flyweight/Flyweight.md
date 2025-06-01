The Flyweight Design Pattern is a structural pattern used to minimize memory usage or computational expenses by sharing as much data as possible with similar objects. It’s useful when your application needs to create a large number of similar objects.

🧠 Key Concepts

- Intrinsic state: Shared data that is independent of the context.
- Extrinsic state: Context-specific data that can’t be shared.

🧪 Example: A Tree Rendering System

Imagine a game that needs to render thousands of trees. Most trees share the same texture and color, but each has a different position.


✅ Flyweight Pattern in JavaScript

```js
// Flyweight Object
class TreeType {
  constructor(name, color, texture) {
    this.name = name;        // Intrinsic
    this.color = color;      // Intrinsic
    this.texture = texture;  // Intrinsic
  }

  draw(x, y) {
    console.log(`Drawing a ${this.name} tree at (${x}, ${y}) with color ${this.color} and texture ${this.texture}`);
  }
}

// Flyweight Factory
class TreeFactory {
  constructor() {
    this.treeTypes = {};
  }

  getTreeType(name, color, texture) {
    const key = `${name}_${color}_${texture}`;
    if (!this.treeTypes[key]) {
      this.treeTypes[key] = new TreeType(name, color, texture);
    }
    return this.treeTypes[key];
  }
}

// Tree Object (uses extrinsic state)
class Tree {
  constructor(x, y, treeType) {
    this.x = x;           // Extrinsic
    this.y = y;           // Extrinsic
    this.treeType = treeType;
  }

  draw() {
    this.treeType.draw(this.x, this.y);
  }
}

// Forest that contains many trees
class Forest {
  constructor() {
    this.trees = [];
    this.treeFactory = new TreeFactory();
  }

  plantTree(x, y, name, color, texture) {
    const treeType = this.treeFactory.getTreeType(name, color, texture);
    const tree = new Tree(x, y, treeType);
    this.trees.push(tree);
  }

  draw() {
    this.trees.forEach(tree => tree.draw());
  }
}

// Usage
const forest = new Forest();
forest.plantTree(10, 20, 'Oak', 'Green', 'Rough');
forest.plantTree(50, 80, 'Oak', 'Green', 'Rough');
forest.plantTree(25, 35, 'Pine', 'Dark Green', 'Smooth');

forest.draw();

```

🧾 Output

```
Drawing a Oak tree at (10, 20) with color Green and texture Rough
Drawing a Oak tree at (50, 80) with color Green and texture Rough
Drawing a Pine tree at (25, 35) with color Dark Green and texture Smooth

```

✅ Benefits
- Reduces memory consumption.
- Improves performance with large numbers of similar objects.

❗ When to Use
- When many objects share common data.
- When performance/memory is critical.

Let me know if you'd like to see a Flyweight implementation in a real-world UI case (like DOM elements or canvas).


```html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Flyweight Pattern - Bullet Shooting Game</title>
  <style>
    canvas {
      border: 2px solid black;
      display: block;
      margin: 20px auto;
    }
  </style>
</head>
<body>
  <h2 style="text-align:center;">Flyweight Pattern: Bullet Shooter</h2>
  <canvas id="gameCanvas" width="800" height="400"></canvas>

  <script>
    class BulletType {
      constructor(color, speed) {
        this.color = color;
        this.speed = speed;
      }

      draw(ctx, x, y) {
        ctx.fillStyle = this.color;
        ctx.beginPath();
        ctx.arc(x, y, 5, 0, Math.PI * 2);
        ctx.fill();
      }
    }

    class BulletFactory {
      constructor() {
        this.bulletTypes = {};
      }

      getBulletType(color, speed) {
        const key = `${color}_${speed}`;
        if (!this.bulletTypes[key]) {
          this.bulletTypes[key] = new BulletType(color, speed);
        }
        return this.bulletTypes[key];
      }
    }

    class Bullet {
      constructor(x, y, bulletType) {
        this.x = x;
        this.y = y;
        this.bulletType = bulletType;
      }

      update() {
        this.x += this.bulletType.speed;
      }

      draw(ctx) {
        this.bulletType.draw(ctx, this.x, this.y);
      }

      isOffScreen(canvasWidth) {
        return this.x > canvasWidth;
      }
    }

    class Game {
      constructor(canvas) {
        this.canvas = canvas;
        this.ctx = canvas.getContext('2d');
        this.bullets = [];
        this.bulletFactory = new BulletFactory();
        this.initControls();
        this.loop();
      }

      initControls() {
        this.canvas.addEventListener('click', (e) => {
          const y = e.clientY - this.canvas.getBoundingClientRect().top;
          const redBullet = this.bulletFactory.getBulletType('red', 5);
          const blueBullet = this.bulletFactory.getBulletType('blue', 8);
          this.bullets.push(new Bullet(0, y, redBullet));
          this.bullets.push(new Bullet(0, y + 10, blueBullet));
        });
      }

      loop() {
        requestAnimationFrame(() => this.loop());
        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);

        this.bullets.forEach(bullet => bullet.update());
        this.bullets = this.bullets.filter(bullet => !bullet.isOffScreen(this.canvas.width));
        this.bullets.forEach(bullet => bullet.draw(this.ctx));
      }
    }

    const canvas = document.getElementById('gameCanvas');
    const game = new Game(canvas);
  </script>
</body>
</html>

```