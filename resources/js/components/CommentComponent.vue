<template>
  <div>
    <label>Komentarz </label>
    <textarea class="form-control" @blur="checkAddComment" v-model="description" required></textarea>
    <div><small class="text-danger mb-2" v-if="isError">Uzupełnij pole z komentarzem</small></div>
    <button @click="addComment" class="btn btn-sm btn-primary m-t-xs add-comment-warning" :disabled="disabled_add_button"
      >Dodaj komentarz</button>
  </div>

  <div v-for="comment in comments">
    <div class="feed-element">
      <div class="text-right m-b-xs">
          <button @click="deleteComment(comment.id)" class="btn btn-xs btn-micro btn-danger">Usuń</button>
      </div>
      <div class="media-body border-l">
          <div class="pos-comment">
              <div class="well">
                  {{ comment.description }}
              </div>
          </div>
      </div>
    </div>
  </div>

</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      projectId: null,
      isError: false,
      disabled_add_button: true,
      description: '',
      comments: {}
    };
  },
  methods: {
    getComments() {
      var projectId = this.projectId;

      axios.get(`/project/${projectId}/comments`)
           .then(response => {
              this.comments = response.data
          });
    },

    getProjectId() {
      var currentUrl = window.location.href;
      var lastIndex = currentUrl.lastIndexOf('/');
      return parseInt(currentUrl.substring(lastIndex + 1));
    },

    addComment() {
      axios.post(`/project/${this.projectId}/comment`, {
        description:this.description
      })
      .then(response => {
        this.isError = false;
        this.loadComments();
      })
      .catch(error => {
        this.isError = true
      });
    },

    loadComments() {
      this.comments = this.getComments();
    },

    deleteComment(id) {
      axios.delete(`/project/${this.projectId}/comment/${id}`)
      .then(response => {
        this.loadComments();
      });
    },

    checkAddComment() {
      this.disabled_add_button = this.description.length > 0 ? false : true;
    }
  },

  mounted() {
    this.projectId = this.getProjectId();
    this.loadComments();
  },
  props: [],
};
</script>
