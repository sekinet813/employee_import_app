<template>
  <div
    class="drop-area"
    @dragover.prevent
    @drop="handleDrop"
    @click="this.$refs.fileInput.click"
  >
    <input
      ref="fileInput"
      type="file"
      accept=".csv"
      style="display: none"
      @change="handleFileUpload"
    />
    <p v-if="!file">ドラッグ&ドロップでCSVファイルをアップロード</p>
    <p v-else>{{ file.name }} が選択されました</p>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      file: null,
    };
  },
  methods: {
    handleDrop(event) {
      const file = event.dataTransfer.files[0];
      if (!file) return;
      this.uploadFile(file);
    },
    handleFileUpload(event) {
      const file = event.target.files[0];
      if (!file) return;
      this.uploadFile(file);
    },
    async uploadFile(file) {
      if (!file) return;
      this.file = file;

      const formData = new FormData();
      formData.append('file', file);

      try {
        await axios.post('/api/upload-csv', formData);
        alert('CSVファイルがアップロードされました');
        // 親コンポーネントにデータ更新を通知
        this.$emit('data-updated');
      } catch (error) {
        console.error('アップロードエラー:', error);
        alert('エラーが発生しました');
      }

      // inputの値をクリア
      this.$refs.fileInput.value = null;
      this.file = null;
    },
  },
};
</script>

<style scoped>
.drop-area {
  border: 2px dashed #ccc;
  padding: 20px;
  text-align: center;
  cursor: pointer;
}
</style>
