class Notification {
  constructor(id, read_at, updated_at, message, slug, created_at) {
    this.id = id;
    this.read_at = read_at;
    this.updated_at = updated_at;
    this.message = message;
    this.slug = slug;
    this.created_at = created_at;
  }

  notificationItem() {
    if(this.read_at == null) {
        return `
        <li class="collection-item notification">
            <a href="#" class="blue-text" onclick="markAsRead('${this.id}')">
              <i class="blue-text fa fa-circle"></i>
            </a>
            <a href="/blog/read/${this.slug}" class="black-text" target="_blank">
              ${this.message}
            </a> <br>
            <small>${this.slug}</small>
        </li>
        `;
    }else {
        return `
        <li class="collection-item notification">
            <i class="blue-text fa fa-circle grey-text"></i>
            <a href="/blog/read/${this.slug}" class="black-text" target="_blank">
              ${this.message}
            </a> <br>
            <small>${this.slug}</small>
        </li>
    `;/* ===================== IF NOTIFICATION MARK AS READ =================*/
    }
  }

}

function markAsRead(id) {
  $.ajax({
    type:'post',
    url:`${url}/notification/read/${id}`
  }).done((res) => {
    $('.notification').remove()
    getNotifications();
    console.log(res);
  }).fail((err) => {
    console.log(err);
  });
}


$(document).ready(() => { getNotifications() });

let notificationURL = `${url}/notification/json`;
function getNotifications() {
  loader();
  $.ajax({
    type:'get',
    url:notificationURL
  }).done((res) => {
    swal.close();
    console.log(res);
    getNotifNumber(res.count);
    for(var x in res.notifications.data) {
      let notification1 = new Notification(
        res.notifications.data[x].id, 
        res.notifications.data[x].read_at, 
        res.notifications.data[x].updated_at, 
        res.notifications.data[x].data.message, 
        res.notifications.data[x].data.slug, 
        res.notifications.data[x].created_at
      );
      $('.notifications-container').append(notification1.notificationItem());
    }
  }).fail((err) => {
    console.log(err)
  });
}

function getNotifNumber(count) {
  $('#notification-count').remove();
  $('#count').append(`
    <a href="/profile/notifications" id="notification-count">
      <i class="fa fa-bell"></i> 
      <span class="red notification-count">
        ${count}
      </span>
    </a>
  `);
}