<template>
    <div>
        <h1 class="font-weight-bold"></h1>
        
        <form>
            <div class="form-group">
                <label for="inputTitle">Title</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Title" v-model="article.title">
            </div>
            <div class="pt-2">
                <label for="">Body</label>
            </div>
            <div class="d-flex flex-col form-group">
                <textarea v-model="article.body" name="" id="" cols="70" rows="8"></textarea>
            </div>
            <div class="form-group pt-2">
                <label for="exampleFormControlFile1">Example file input</label>
                <input type="file" class="form-control-file" id="exampleFormControlFile1">
            </div>
            <button @click.prevent="updateArticle" type="submit" class="btn btn-primary pt-10">Submit</button>
        </form>
    </div>
</template>

<script>


export default ({   
    props: ['article_id'],
    data() {
        return {
            article: {}
        }
    },

    created() { 
        this.getArticle(this.article_id)
    },   

    methods: {
       async getArticle(articleId) {
            let config = {
                method: "get",
                url: `${window.location.origin}/api/articles/${articleId}`,
            }
             
            await axios(config).then((response) => {
                this.article = response.data
            }).catch((error) => {
                console.log(error)
            })
        },

        updateArticle() {
             let config = {
                method: "put",
                url: `${window.location.origin}/api/articles/${this.article.id}`,
                data: this.article,
            }
             
            axios(config).then((response) => {
                window.location = `${window.location.origin}/home`
            }).catch((error) => {
                console.log(error)
            })
        }
    }
})
</script>
