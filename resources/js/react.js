import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

    window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.REACT_APP_WEBSOCKETS_KEY,
    wsHost: process.env.REACT_APP_WEBSOCKETS_SERVER,
    wsPort: 6001,
    forceTLS: false,
    disableStats: true
});

function componentDidMount(){
    window.Echo.channel('channel').listen('Websockets', (e)=>{
        console.log(e)
    });
}
