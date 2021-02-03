<style scoped>
.text {
   display: block;/* or inline-block */
  text-overflow: ellipsis;
  word-wrap: break-word;
  overflow: hidden;
  max-height: 3.6em;
  line-height: 1.8em;
}
</style>

<template>
<div>
    <div class="text-2xl text-grey-800">
       Home Page

    </div>

 <div class="flex flex-wrap w-full justify-center items-center">

  <section class="w-full md:w-2/4 flex flex-col items-center px-3">
    <article v-for="item in items" :key="item.id" class="flex flex-col shadow my-4">
            <router-link
                      :to="{ name: 'Detail', params: { id: item.id } }"
                      >
      <a  class="hover:opacity-75">
        <img 

           
             :src="'/images/' + item.photo"
        />
      </a>
      <div class="bg-white flex flex-col justify-start p-6">
        <a  class="text-blue-700 text-sm font-bold uppercase pb-4"
          >{{item.topic}}</a
        >
        <a  class="text-3xl font-bold hover:text-gray-700 pb-4"
          >{{item.title}}</a
        >
        <p  class="text-sm pb-3">
          By
          <a class="font-semibold hover:text-gray-800">{{item.created_by}}</a>,
          Published on {{item.created_at}}
        </p>
        <p  class="pb-6 text"
          >{{item.content}}</p
        >
        <a  class="my-4 uppercase text-gray-800 hover:text-black"
          >Continue Reading <i class="fas fa-arrow-right"></i
        ></a>
      </div>
</router-link
                    >
    </article>

    <!-- <article class="flex flex-col shadow my-4">

      <a href="#" class="hover:opacity-75">
        <img
          src="https://source.unsplash.com/collection/1346951/1000x500?sig=2"
        />
      </a>
      <div class="bg-white flex flex-col justify-start p-6">
        <a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4"
          >Automotive, Finance</a
        >
        <a href="#" class="text-3xl font-bold hover:text-gray-700 pb-4"
          >Lorem Ipsum Dolor Sit Amet Dolor Sit Amet</a
        >
        <p href="#" class="text-sm pb-3">
          By
          <a href="#" class="font-semibold hover:text-gray-800">David Grzyb</a>,
          Published on January 12th, 2020
        </p>
        <a href="#" class="pb-6"
          >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus quis
          porta dui. Ut eu iaculis massa. Sed ornare ligula lacus, quis iaculis
          dui porta volutpat. In sit amet posuere magna..</a
        >
        <a href="#" class="uppercase text-gray-800 hover:text-black"
          >Continue Reading <i class="fas fa-arrow-right"></i
        ></a>
      </div>
    </article>

    <article class="flex flex-col shadow my-4">

      <a href="#" class="hover:opacity-75">
        <img
          src="https://source.unsplash.com/collection/1346951/1000x500?sig=3"
        />
      </a>
      <div class="bg-white flex flex-col justify-start p-6">
        <a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4"
          >Sports</a
        >
        <a href="#" class="text-3xl font-bold hover:text-gray-700 pb-4"
          >Lorem Ipsum Dolor Sit Amet Dolor Sit Amet</a
        >
        <p href="#" class="text-sm pb-3">
          By
          <a href="#" class="font-semibold hover:text-gray-800">David Grzyb</a>,
          Published on October 22nd, 2019
        </p>
        <a href="#" class="pb-6"
          >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus quis
          porta dui. Ut eu iaculis massa. Sed ornare ligula lacus, quis iaculis
          dui porta volutpat. In sit amet posuere magna..</a
        >
        <a href="#" class="uppercase text-gray-800 hover:text-black"
          >Continue Reading <i class="fas fa-arrow-right"></i
        ></a>
      </div>
    </article> -->

    <!-- Pagination -->
    <!-- <div class="flex items-center py-8">
                <a href="#" class="h-10 w-10 bg-blue-800 hover:bg-blue-600 font-semibold text-white text-sm flex items-center justify-center">1</a>
                <a href="#" class="h-10 w-10 font-semibold text-gray-800 hover:bg-blue-600 hover:text-white text-sm flex items-center justify-center">2</a>
                <a href="#" class="h-10 w-10 font-semibold text-gray-800 hover:text-gray-900 text-sm flex items-center justify-center ml-3">Next <i class="fas fa-arrow-right ml-2"></i></a>
            </div> -->
  </section>
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

  mounted() {
    axios.get("/api/article/articles").then((response) => {
      this.items = response.data;

      console.log(this.items);
    });
  },
};
</script>