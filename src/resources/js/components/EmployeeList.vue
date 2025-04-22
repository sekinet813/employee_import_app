<template>
  <div>
    <CsvUploader @data-updated="fetchEmployees" />
    <br>
    <h1>従業員一覧</h1>
    <table v-if="employees.length">
      <thead>
        <tr>
          <th>名前</th>
          <th>メール</th>
          <th>職種</th>
          <th>部署</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(employee, index) in employees" :key="index">
          <td>{{ employee.name }}</td>
          <td>{{ employee.email }}</td>
          <td>{{ employee.position }}</td>
          <td>{{ employee.department }}</td>
        </tr>
      </tbody>
    </table>
    <p v-else>従業員データがありません。</p>
    <button 
      @click="truncateEmployees"
      class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500"
    >
      従業員データを全件削除
    </button>
  </div>
</template>

<script>
import axios from 'axios';
import CsvUploader from './CsvUploader.vue';

export default {
  components: {
    CsvUploader,
  },
  data() {
    return {
      employees: [],
    };
  },
  async created() {
    this.fetchEmployees();  // 初期ロード時にデータを取得
  },
  methods: {
    async fetchEmployees() {
      try {
        const response = await axios.get('/api/employees');
        this.employees = response.data;
      } catch (error) {
        console.error('従業員データ取得エラー:', error);
      }
    },
    async truncateEmployees() {
      try {
        await axios.post('/api/truncate-employees');
        this.employees = [];
        alert('社員データを全件削除しました');
      } catch (error) {
        console.error('社員データ削除エラー:', error);
      }
    },
  },
};
</script>
