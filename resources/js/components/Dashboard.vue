<template>
<div>
    <div class="text-2xl text-gray-800">
        Dashboard Admin   
      <button
        @click.prevent="logout"
        type="submit"
        class="flex text-white bg-indigo-500 border-0 py-1 px-2 focus:outline-none hover:bg-indigo-600 rounded text-lg"
      >
        Sign Out
      </button>


    </div>
    <!-- <code>{{user}}</code> -->



    <div class="p-2 w-full mt-4">
      <router-link to="/article/create">
        <button
          class="flex text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg"
        >
          Create Article
        </button>
      </router-link>
    </div>

    <div class="flex flex-col">
      <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
          <div
            class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
          >
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                  >
                    Thumbnail
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                  >
                    Title
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                  >
                    Created At
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                  >
                    Created By
                  </th>
                  <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Action</span>
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="item in items" :key="item.id">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div class="flex-shrink-0 h-10 w-10">
                        <img
                          class="h-10 w-10 rounded-full"
                          :src="'/images/' + item.photo"
                          alt=""
                          title=""
                        />
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">{{ item.title }}</div>
                    <div class="text-sm text-gray-500">{{ item.topic }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span
                      class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"
                    >
                      {{ item.created_at }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ item.created_by }}
                  </td>
                  <td
                    class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                  >
                    <router-link
                      :to="{ name: 'Update', params: { id: item.id } }"
                      class="bg-blue-500 text-white px-1 py-1 rounded-md text-sm font-medium"
                      >Update</router-link
                    >

                    <button
                      @click="deleteArticle(item.id)"
                      class="bg-red-500 text-white px-1 py-1 rounded-md text-sm font-medium"
                    >
                      Delete
                    </button>
                  </td>
                </tr>

                <!-- More items... -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      items: null,
    };
  },
  methods: {
    logout() {


                  swal
        .fire({
          title: "Sign Out?",
          text: "Bye bye !",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Okay",
          cancelButtonText: "Cancel",
        })
        .then((result) => {
          if (result.value) {
            toast.fire({
              type: "error",
              title: "Admin Signed Out !",
            });

            axios.post("/api/logout").then(() => {
        this.$router.push({ name: "Home" });
      });
      
          }
        });


    
    },

    deleteArticle(id) {
      swal
        .fire({
          title: "Are You Sure?",
          text: "This article will be deleted permanently",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Okay",
          cancelButtonText: "Cancel",
        })
        .then((result) => {
          if (result.value) {
            toast.fire({
              type: "success",
              title: "Article Deleted successfully",
            });

            axios
              .delete("/api/article/delete/" + id)
              .then(() => {
                axios.get("/api/article/articles").then((response) => {
                  this.items = response.data;

                  console.log(this.items);
                });
              })
              .catch((error) => {
                console.log(error);
              });
          }
        });
    },
  },

  mounted() {
    axios.get("/api/article/articles").then((response) => {
      this.items = response.data;

      console.log(this.items);
    });
  },
};
</script>