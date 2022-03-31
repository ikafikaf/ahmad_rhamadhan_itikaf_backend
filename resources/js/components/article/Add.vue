<template>
    <div>
        <h1 class="font-weight-bold"></h1>
        
        <form>
            <div class="form-group">
                <label for="inputTitle">Title</label>
                <input v-model="article.title" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Title">
                
            </div>
            <div class="pt-2">
                <label for="">Body</label>
            </div>
            <div class="d-flex flex-col form-group">
                <textarea v-model="article.body" name="" id="" cols="70" rows="8"></textarea>
            </div>
            <div class="form-group pt-2">
                <label for="exampleFormControlFile1">Example file input</label>
                <input @change="onFileChange($event)" type="file" class="form-control-file" id="exampleFormControlFile1">
            </div>
            <button @click.prevent="addArticle" type="submit" class="btn btn-primary pt-10">Submit</button>
        </form>
    </div>
</template>

<script>

export default ({   
    data() {
        return {
            article: {},
            files: {}
        }
    },

    created() {
        console.log("test loaded")
    },

    methods: {
        addArticle() {      
            let formData = new FormData();
            formData.append('title', this.article.title)
            formData.append('body', this.article.body)
            formData.append('image', this.files)

            let config = {
                method: "post",
                url: `${window.location.origin}/api/articles`,
                data: formData,
                headers: {
                    "content-type": "multipart/form-data"
                }

            }
            
            axios(config).then((response) => {
                window.location = window.location.origin
            }).catch((error) => {
                console.log(error)
            })
        },

        onFileChange($event) {
            this.files = $event.target.files[0]
        },


    }

   
})
</script>
