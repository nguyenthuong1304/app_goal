<template>
  <button
    class="btn-sm shadow-none border border-primary p-1 w-100 h-100 d-block"
    :class="buttonColor"
    @click="clickFollow"
    >
    <i
    class="mr-1"
    :class="buttonIcon"
    ></i>
    {{ buttonText }}
  </button>
</template>

<script>
export default {
  props: {
    initialIsFollowedBy: {
      type: Boolean,
      default: false,
    },
    authorized: {
      type: Boolean,
      default: false,
    },
    endpoint: {
      type: String,
    },
  },
  data() {
    return {
      isFollowedBy: this.initialIsFollowedBy,
    }
  },
  computed: {
    buttonColor() {
      return this.isFollowedBy
        ? 'bg-primary text-white'
        : 'bg-white'
    },
  buttonIcon() {
    return this.isFollowedBy
      ? 'fas fa-user-check'
      : 'fas fa-user-plus'
    },

  buttonText() {
    return this.isFollowedBy
      ? 'Đã theo dõi'
      : 'Theo dõi'
    },
  },
  methods: {
    handleAfterFollow(count) {
      const Element = document.getElementById("follower").firstChild;
      Element.innerHTML = count;
    },
    clickFollow() {
      if (!this.authorized) {
        alert('Chức năng theo dõi chỉ có thể được sử dụng khi đã đăng nhập')
        return
      }

      this.isFollowedBy
       ? this.unfollow()
       : this.follow()
    },
    async follow() {
      const res = await axios.put(this.endpoint);
      this.isFollowedBy = true;
      this.handleAfterFollow(res.data.count || 0);
    },
    async unfollow() {
      const res = await axios.delete(this.endpoint);
      this.isFollowedBy = false;
      this.handleAfterFollow(res.data.count || 0);
    },
  },
}
</script>
