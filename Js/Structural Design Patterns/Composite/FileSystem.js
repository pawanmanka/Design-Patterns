class FileSystemItem {
  constructor(name) {
    this.name = name;
  }

  show(indent = 0) {
    throw new Error("Must implement show() in subclass");
  }
}

class File extends FileSystemItem {
  show(indent = 0) {
    console.log(' '.repeat(indent) + `|📄 ${this.name}`);
  }
}
class Folder extends FileSystemItem {
   constructor(name) {
    super(name);
    this.children = [];
  }

  add(item) {
    this.children.push(item);
  }

  show(indent = 0) {
    console.log(' '.repeat(indent) + `- 📁 ${this.name}`);
    this.children.forEach(child => child.show(indent + 2));
  }
}

// create root folder
const root = new Folder("root");

// create Documents folder
const documents = new Folder("Documents");
// add files in  Documents folder
documents.add(new File("resume.pdf")); 
documents.add(new File("cover_letter.docx"));

// create Photos folder
const photos = new Folder("Photos");
// add files in  Photos folder
photos.add(new File("vacation.jpg"));
photos.add(new File("birthday.png"));
// added them in root folder
root.add(documents);
root.add(photos);
// add file in root
root.add(new File("readme.txt"));


root.show();


