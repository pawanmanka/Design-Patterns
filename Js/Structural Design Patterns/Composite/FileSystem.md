**📁 Composite Pattern: File System Example**
A file system consists of:
- Files (individual elements, a.k.a. Leaf)
- Folders (containers that can hold files or other folders, a.k.a. Composite)
You want to be able to call a uniform method like show() for both.

**🧱 Base Component**

```js
class FileSystemItem {
  constructor(name) {
    this.name = name;
  }

  show(indent = 0) {
    throw new Error("Must implement show() in subclass");
  }
}

```

**📄 Leaf: File**

```js
class File extends FileSystemItem {
  show(indent = 0) {
    console.log(' '.repeat(indent) + `📄 ${this.name}`);
  }
}

```

**📁 Composite: Folder**

```js
class Folder extends FileSystemItem {
  constructor(name) {
    super(name);
    this.children = [];
  }

  add(item) {
    this.children.push(item);
  }

  show(indent = 0) {
    console.log(' '.repeat(indent) + `📁 ${this.name}`);
    this.children.forEach(child => child.show(indent + 2));
  }
}

```

**✅ Usage**

```js
const root = new Folder("root");

const documents = new Folder("Documents");
documents.add(new File("resume.pdf"));
documents.add(new File("cover_letter.docx"));

const photos = new Folder("Photos");
photos.add(new File("vacation.jpg"));
photos.add(new File("birthday.png"));

root.add(documents);
root.add(photos);
root.add(new File("readme.txt"));

root.show();

```

#

**🖨️ Output**

```js
📁 root
  📁 Documents
    📄 resume.pdf
    📄 cover_letter.docx
  📁 Photos
    📄 vacation.jpg
    📄 birthday.png
  📄 readme.txt

```