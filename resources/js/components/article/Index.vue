<template>  
    <div>   
        <div>
            <h1 class="font-weight-bold"></h1>
            <div class="container">
                <button class="btn btn-primary" @click.prevent="handleAdd">
                    Add Article
                </button>
            </div>
        </div>
          <div v-for="article in articles" :key="article.id" class="container mt-3">
            <h2>{{ article.title }}</h2>
            <div class="card">
                <div style="" class="d-flex justify-content-center p-2">
                    <img class="w-50" :src="formatImageURL(article.image_url)" alt="">
                </div>
                <div class="card-body items-right">
                   <p>{{ article.body }}</p>  
                    <button class="btn btn-info" @click.prevent="handleView(article.id)">
                        View
                    </button>
                    <button v-show="article.user_id === userState.id"  class="btn btn-info" @click.prevent="handleEdit(article.id)" >
                        Edit
                    </button>
                    <button v-show="article.user_id === userState.id"  class="btn btn-danger" @click.prevent="handleDelete(article.id)">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
  
</template>

<script>


export default ({
    props: ['user'],
    data() {
        return {
            userState: {},
            articles: []
        }
    },

    created() {
        this.fetchArticles()
        this.userState = JSON.parse(this.user);
    },

    methods: {
        async fetchArticles() {
            let config = {
                method: "get",
                url: `${window.location.origin}/api/articles`,
            }
             
            await axios(config).then((response) => {
                console.log(response)
                this.articles = response.data
            }).catch((error) => {
                console.log(error)
            })
        },  

        async handleDelete(articleId) {
            let config = {
                method: "delete",
                url: `${window.location.origin}/api/articles/${articleId}`,
            }
             
            await axios(config).then((response) => {
                this.fetchArticles()
            }).catch((error) => {
                console.log(error)
            })
        },

        handleEdit(articleId) {
            window.location = `${window.location.origin}/edit/${articleId}`
        },

        handleAdd() {
            window.location = `${window.location.origin}/add`
        },

        handleView(articleId) {
            window.location = `${window.location.origin}/article/${articleId}`
        },
        formatImageURL(url) {
            return `${window.location.origin}/storage/${url}`
        }
    }

})
</script>
