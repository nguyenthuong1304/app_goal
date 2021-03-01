window._ = require('lodash');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


import Echo from 'laravel-echo';
window.io = require('socket.io-client');


window.Echo = new Echo({
    // namespace: 'App\\Events\\FollowedEvent',
    broadcaster: 'socket.io',
    host: window.location.hostname +':6001'
});
window.Echo.channel('private-user.1')
    .listen('.log.added', (e) => {
        console.log(e.log);
    });
