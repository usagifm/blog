<template>
<div>
    <div class="text-2xl text-gray-800">
        Detail Article

    </div>
  <div class="flex flex-wrap w-full justify-center items-center">
      

  <section class="w-full md:w-2/3 flex flex-col items-center px-3">

            <article class="flex flex-col shadow my-4">
                <!-- Article Image -->
                <a class="hover:opacity-75">
                    <img :src="'/images/' + data.photo">
                </a>
                <div class="bg-white flex flex-col justify-start p-6">
                    <a class="text-blue-700 text-sm font-bold uppercase pb-4">{{data.topic}}</a>
                    <a  class="text-3xl font-bold hover:text-gray-700 pb-4">{{data.topic}}</a>
                    <p class="text-sm pb-8">
                        By <a  class="font-semibold hover:text-gray-800">{{data.created_by}}</a>, Published on {{data.created_at}}
                    </p>
                    <h3 class="text-2xl font-bold pb-3">Content</h3>
                    <p class="pb-3">{{data.content}}</p>
 </div>
            </article>

        </section>

  </div>
</div>
</template>
<script>
export default {
  data() {
    return {
      data: {},
  
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
//   methods: {
//     selectFile(event) {
//       this.form.photo = event.target.files[0];

//       console.log(this.form.photo);
//     },

//     updateArticle() {
//       this.form.title = this.data.title;
//       this.form.topic = this.data.topic;
//       this.form.content = this.data.content;

//       const formData = new FormData();
//       formData.append("photo", this.form.photo);
//       formData.append("title", this.form.title);
//       formData.append("content", this.form.content);
//       formData.append("topic", this.form.topic);

//       console.log(" Isinya : ");
//       console.log(this.form.photo);

//       axios
//         .post("/api/article/update/" + this.$route.params.id, formData)
//         .then((response) => {
//                toast.fire({
//                       type: 'success',
//                       title: 'Article Updated successfully'
//                     })
//           this.$router.push({ name: "Dashboard" });
//         })
//         .catch((error) => {
//           this.errors = error.response.data.errors;
//         });
//     },
//   },
};
</script>