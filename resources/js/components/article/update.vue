<template>
<div>

  <div class="flex flex-wrap w-full justify-center items-center">
    <div class="flex flex-wrap max-w-xl">
      <div class="p-2 text-2xl text-gray-800 font-semibold">
        <h1>Update Article</h1>
      </div>
      <div class="p-2 w-full">
        <label class="w-full" for="name">Title</label>
        <input
          class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2"
          placeholder="Title"
          type="text"
          v-model="data.title"
        />
      </div>
      <div class="p-2 w-full">
        <label class="w-full" for="name">Topic</label>
        <input
          class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2"
          placeholder="Title"
          type="text"
          v-model="data.topic"
        />
      </div>

      <div class="p-2 w-full">
        <label for="email">Content</label>
        <textarea
          class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2"
          placeholder="Content"
          type="text"
          v-model="data.content"
        >
        </textarea>
      </div>
      <div class="p-2 w-full">
        <label for="password">Photo</label>
        <input
          @change="selectFile"
          class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2"
          placeholder="Password"
          type="file"
          name="password"
        />
      </div>

      <div class="p-2 w-full mt-4">
        <button
          @click.prevent="updateArticle"
          type="submit"
          class="flex text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg"
        >
          Update
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
      data: {},
      form: {
        title: "",
        content: "",
        photo: "",
        topic: "",
      },

      errors: [],
    };
  },

  created() {
    axios
      .get("/api/article/show/" + this.$route.params.id)
      .then((response) => {
        this.data = response.data;
      })
      .catch((error) => {
        console.log(error);
      });
  },
  methods: {
    selectFile(event) {
      this.form.photo = event.target.files[0];

      console.log(this.form.photo);
    },

    updateArticle() {
      this.form.title = this.data.title;
      this.form.topic = this.data.topic;
      this.form.content = this.data.content;

      const formData = new FormData();
      formData.append("photo", this.form.photo);
      formData.append("title", this.form.title);
      formData.append("content", this.form.content);
      formData.append("topic", this.form.topic);

      console.log(" Isinya : ");
      console.log(this.form.photo);

      axios
        .post("/api/article/update/" + this.$route.params.id, formData)
        .then((response) => {
               toast.fire({
                      type: 'success',
                      title: 'Article Updated successfully'
                    })
          this.$router.push({ name: "Dashboard" });
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
  },
};
</script>