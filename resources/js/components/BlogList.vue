<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="card p-5 shadow border-0">
                    <div class="row mt-0">
                        <div class="col-md-12 ">
                            <h4 class="">Add New Blog</h4>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-12 mb-0">
                            <p class="mb-1">Title</p>
                            <input id="title" type="text" placeholder="Title" name="title"
                                class="form-control input-box rm-border" v-model="title">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 mb-2">
                            <p class="mb-1">Description</p>
                            <textarea id="message" type="text" placeholder="Enter your message" name="message"
                                class="form-control input-box rm-border" v-model="description"></textarea>
                        </div>
                    </div>

                    <div class="form-group row justify-content-center mb-0">
                        <div class="col-md-12 px-3 text-end">
                            <button class="btn btn-primary px-4 btn-block  rm-border" v-if="!editId" @click="SaveData">Add</button>
                            <button class="btn btn-primary px-4 btn-block  rm-border" v-else  @click="UpdateData(editId)">Update</button>
                            <button type="reset" class="btn btn-dark px-4 btn-block  rm-border" @click="ResetData()" >Reset</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card mb-2 w-100">
                    <div class="card-body">
                        <table class=" w-100">
                            <tr v-for="blog in blogs" :key="blog.id">
                                <td>
                                    <h4 class="h4 fw-bolder mb-0 pb-0">{{ blog.title }}</h4>
                                    <p class="text-muted mt-0 pt-0">{{ blog.description }}</p>
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-sm" @click="editBlog(blog.id)">Edit</button>
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-sm" @click="deleteBlog(blog.id)">Del</button>                                </td>
                            </tr>
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
            blogs: [],
            title:'',
            description:'',
            editId:'',
        }
    },
    mounted() {
        this.axios
            .get('http://127.0.0.1:8000/api/blog')
            .then(response => {
                this.blogs = response.data;
                // console.log(response.data);
            });
    },
    methods: {
        deleteBlog(id) {
            this.axios
                .delete('http://127.0.0.1:8000/api/blog/' + id)
                .then(response => {
                    this.axios
                        .get('http://127.0.0.1:8000/api/blog')
                        .then(response => {
                            this.blogs = response.data;
                            // console.log(response.data);
                        });
                });
        },

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
        },
        editBlog(id){
            this.axios
                .get('http://127.0.0.1:8000/api/edit-blog/'+id)
                .then(response => {
                    this.title = response.data.title,
                    this.description = response.data.title,
                    this.editId = response.data.id
                });
        },
        UpdateData(id){
           let updateVal = {
                'title':this.title,
                'description':this.description,
            };
            this.axios
                .patch('http://127.0.0.1:8000/api/blog/'+id, updateVal)
                .then(response => {
                      this.axios
                        .get('http://127.0.0.1:8000/api/blog')
                        .then(response => {
                            this.title = '',
                            this.description = '',
                            this.editId = '',
                            this.axios
                            .get('http://127.0.0.1:8000/api/blog')
                            .then(response => {
                                this.blogs = response.data;
                                // console.log(response.data);
                            });
                        });
                });
        },
        ResetData(){
            this.title = '',
            this.description = '',
            this.editId = ''
        }
    },
}
</script>
