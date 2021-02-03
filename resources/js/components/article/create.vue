<template>
  <div>
    <div class="flex flex-wrap w-full justify-center items-center">
      <div class="flex flex-wrap max-w-xl">
        <div class="p-2 text-2xl text-gray-800 font-semibold">
          <h1>Create Article</h1>
        </div>
        <div class="p-2 w-full">
          <label class="w-full" for="name">Title</label>
          <input
            class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2"
            placeholder="Title"
            type="text"
            v-model="form.title"
          />
        </div>
        <div class="p-2 w-full">
          <label class="w-full" for="name">Topic</label>
          <input
            class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2"
            placeholder="Title"
            type="text"
            v-model="form.topic"
          />
        </div>

        <div class="p-2 w-full">
          <label for="email">Content</label>
          <textarea
            class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2"
            placeholder="Content"
            type="text"
            v-model="form.content"
          >
          </textarea>
        </div>
        <div class="p-2 w-full">
          <label for="password">Photo</label>
          <input
            @change="selectFile"
            class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2"
            placeholder="Password"
            accept="image/*"
            type="file"
            name="password"
          />
        </div>

        <div class="p-2 w-full mt-4">
          <button
            @click.prevent="createArticle"
            type="submit"
            class="flex text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg"
          >
            Create
          </button>
        </div>
        <div style="padding: 10px" v-if="errors != null">
          <p v-for="item in errors" :key="item.index">{{ item[0] }}</p>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      form: {
        title: "",
        content: "",
        photo: null,
        topic: "",
      },
      errors: [],
    };
  },
  methods: {
    selectFile(event) {
      // `files` is always an array because the file input may be in multiple mode
      this.form.photo = event.target.files[0];

      console.log(this.form.photo);
    },

    createArticle() {
      const data = new FormData();
      data.append("photo", this.form.photo);
      data.append("title", this.form.title);
      data.append("content", this.form.content);
      data.append("topic", this.form.topic);

      axios
        .post("/api/article/create", data)
        .then((response) => {
          toast.fire({
            type: "success",
            title: "Article Added successfully",
          });

          this.$router.push({ name: "Dashboard" });
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
  },
};
</script>