<template>
    <div class="card p-5">
        <div class="row mt-0">
            <div class="col-md-12 ">
                <h4 class="">Add New Blog</h4>
                <p>Use the form below to share your questions, ideas, comments and feedback</p>
            </div>
        </div>
        <div class="form-group row mb-3">
            <div class="col-md-12 mb-0">
                <p class="mb-1">Title</p>
                <input id="title" type="text" placeholder="Title" name="title" class="form-control input-box rm-border" v-model="title">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-12 mb-2">
                <p class="mb-1">Description</p>
                <textarea id="message" type="text" placeholder="Enter your message" name="message"
                    class="form-control input-box rm-border" v-model="description"></textarea>
            </div>
        </div>
        {{ blogs }}
        <div class="form-group row justify-content-center mb-0">
            <div class="col-md-12 px-3 text-end">
                <button class="btn btn-primary px-4 btn-block  rm-border" @click="SaveData">Save</button>
            </div>
        </div>
    </div>
</template>

<script>

import BlogList from "./components/BlogList";


export default {
    data(){
        return{
            title:'Vue title',
            description:'Vue Description',
        }
    },
    //  mounted() {
    //      this.axios
    //             .get('http://127.0.0.1:8000/api/blog')
    //             .then(response => {
    //                 this.blogs = response.data;
    //                 // console.log(response.data);
    //             });
    // },

    methods: {
        SaveData(){
            let data = {
                'title':this.title,
                'description':this.description,
            };
            this.axios
                .post('http://127.0.0.1:8000/api/blog',data)
                .then(response => {
                      this.axios
                        .get('http://127.0.0.1:8000/api/blog')
                        .then(response => {
                            this.blogs = response.data;
                            // console.log(response.data);
                        });
                });

        }
    },

}
</script>
