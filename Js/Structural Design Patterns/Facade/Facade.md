In JavaScript, the Facade Pattern is used to provide a simple interface to a complex system of classes, functions, or modules. It's especially useful in situations where you want to hide complexity and reduce dependencies between client code and subsystems.

🧠 What is the Facade Pattern?
The Facade Pattern defines a higher-level interface that makes the subsystem easier to use.


✅ Real-World Analogy
Imagine a universal TV remote: Instead of adjusting brightness, contrast, volume separately, you just press "Watch Movie", and it handles everything behind the scenes.


🧩 Real-World Example in JavaScript: Video Player Facade

Let's build a video player with:
- Audio system
- Video system
- Subtitle system
But instead of the client manually coordinating them, we’ll use a facade.

**👨‍🔧 Subsystems**

```js
class VideoDecoder {
  playVideo(file) {
    console.log(`🎥 Decoding and playing video: ${file}`);
  }
}

class AudioDecoder {
  playAudio(file) {
    console.log(`🔊 Decoding and playing audio: ${file}`);
  }
}

class SubtitleDecoder {
  loadSubtitles(file) {
    console.log(`💬 Loading subtitles from: ${file}`);
  }
}
```
#

**🧱 Facade**

```js
class VideoPlayerFacade {
  constructor() {
    this.videoDecoder = new VideoDecoder();
    this.audioDecoder = new AudioDecoder();
    this.subtitleDecoder = new SubtitleDecoder();
  }

  playMovie(file) {
    console.log(`▶️ Starting movie: ${file}`);
    this.videoDecoder.playVideo(file);
    this.audioDecoder.playAudio(file);
    this.subtitleDecoder.loadSubtitles(file.replace('.mp4', '.srt'));
    console.log(`✅ Movie is now playing`);
  }
}

```

**🚀 Usage**

```js
const player = new VideoPlayerFacade();
player.playMovie("inception.mp4");

```

**🖨️ Output**

```
▶️ Starting movie: inception.mp4
🎥 Decoding and playing video: inception.mp4
🔊 Decoding and playing audio: inception.mp4
💬 Loading subtitles from: inception.srt
✅ Movie is now playing
```

#

**✅ Benefits**

| Feature          | Benefit                                                 |
| ---------------- | ------------------------------------------------------- |
| Simplified usage | One method instead of many                              |
| Encapsulation    | Client doesn’t know or care how systems work internally |
| Loose coupling   | Easier to change subsystems without affecting clients   |

#

**💡 Where You Might Use Facades in JS**

- APIs: A wrapper around fetch that adds auth headers, error handling, etc.
- Animation Libraries: Unified interface to control DOM + canvas animations.
- Complex Libraries (e.g. WebRTC, WebGL): Simplify setup with a facade.
- UI Frameworks: Facade over low-level state & event management.

#

**🧰 Example: API Client Facade**

```js
class ApiClient {
  async getUserData(userId) {
    const res = await fetch(`/api/users/${userId}`);
    return await res.json();
  }

  async updateUser(userId, data) {
    return await fetch(`/api/users/${userId}`, {
      method: "PUT",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(data),
    });
  }
}

```