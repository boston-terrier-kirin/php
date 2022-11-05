const alert = document.querySelector('#alert');
const success = document.querySelector('#success');

alert.addEventListener('click', () => {
  // 毎回消しているつもりでも、2回目以降のanimationが効かない
  // https://stackoverflow.com/questions/36187393/css-animation-wont-apply-for-the-second-time
  clearAlert();

  // 【解決】
  // 毎回消しているつもりでも、2回目以降のanimationが効かない
  // clearAlert でやっているdomのクリアが非同期っぽく、setTimeoutで後回しになれば、domのクリアを待ってから処理できる。
  // 結果としてanimationが効く。
  setTimeout(() => {
    showAlert('アラートメッセージ');
  }, 0);
});

success.addEventListener('click', () => {
  showSuccess('成功しました');
});

function clearAlert() {
  // 2回目以降のanimationが効かない
  // https://stackoverflow.com/questions/36187393/css-animation-wont-apply-for-the-second-time

  const alert = document.querySelector('.alert.alert-danger');
  if (alert) {
    alert.remove();
  }

  const alertContainer = document.querySelector('#alert-container');
  alertContainer.className = '';
}

function showAlert(message) {
  const alert = document.createElement('div');
  alert.className = 'alert alert-danger';
  alert.textContent = message;

  const alertContainer = document.querySelector('#alert-container');
  alertContainer.className = 'show';
  alertContainer.appendChild(alert);
}

function showSuccess(message) {
  const success = document.createElement('div');
  success.className = 'alert alert-success';
  success.textContent = message;

  const successContainer = document.querySelector('#success-container');
  successContainer.className = 'show';
  successContainer.appendChild(success);

  setTimeout(() => {
    success.remove();

    // ここでクリアしないと2回目以降、効かなくなる。
    successContainer.className = '';
  }, 5000);
}
