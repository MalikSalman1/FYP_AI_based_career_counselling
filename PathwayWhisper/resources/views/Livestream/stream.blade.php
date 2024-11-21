<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>{{$livestream->title}}</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='{{ url('/livestream_resources/styles/main.css') }}'>
    <link rel='stylesheet' type='text/css' media='screen' href='{{ url('/livestream_resources/styles/room.css') }}'>
</head>

<body>

    <header id="nav" style="padding-top:36px">
        <div class="nav--list">
            <button id="members__button">
                <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                    clip-rule="evenodd">
                    <path d="M24 18v1h-24v-1h24zm0-6v1h-24v-1h24zm0-6v1h-24v-1h24z" fill="#ede0e0">
                        <path d="M24 19h-24v-1h24v1zm0-6h-24v-1h24v1zm0-6h-24v-1h24v1z" />
                </svg>
            </button>
            <a href="lobby.html" />
            <h3 id="logo">

                <span>Pathway Whispers - Live Stream</span>
            </h3>
            </a>
        </div>

        <div id="nav__links">
            <button id="chat__button"><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg"
                    fill-rule="evenodd" fill="#ede0e0" clip-rule="evenodd">
                    <path
                        d="M24 20h-3v4l-5.333-4h-7.667v-4h2v2h6.333l2.667 2v-2h3v-8.001h-2v-2h4v12.001zm-15.667-6l-5.333 4v-4h-3v-14.001l18 .001v14h-9.667zm-6.333-2h3v2l2.667-2h8.333v-10l-14-.001v10.001z" />
                </svg></button>
            <!-- <a class="nav__link" href="/">
                Lobby
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#ede0e0" viewBox="0 0 24 24"><path d="M20 7.093v-5.093h-3v2.093l3 3zm4 5.907l-12-12-12 12h3v10h7v-5h4v5h7v-10h3zm-5 8h-3v-5h-8v5h-3v-10.26l7-6.912 7 6.99v10.182z"/></svg>
            </a> -->

        </div>
    </header>

    <main class="container">
        <div id="room__container">

            <section id="members__container">

                <div id="members__header">
                    <p>Participants</p>
                    <strong id="members__count">0</strong>
                </div>

                <div id="member__list">
                </div>

            </section>

            <section id="stream__container">

                <div id="stream__box"></div>

                <div id="streams__container"></div>

                <div class="stream__actions">
                    <button id="camera-btn" class="active">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path
                                d="M5 4h-3v-1h3v1zm10.93 0l.812 1.219c.743 1.115 1.987 1.781 3.328 1.781h1.93v13h-20v-13h3.93c1.341 0 2.585-.666 3.328-1.781l.812-1.219h5.86zm1.07-2h-8l-1.406 2.109c-.371.557-.995.891-1.664.891h-5.93v17h24v-17h-3.93c-.669 0-1.293-.334-1.664-.891l-1.406-2.109zm-11 8c0-.552-.447-1-1-1s-1 .448-1 1 .447 1 1 1 1-.448 1-1zm7 0c1.654 0 3 1.346 3 3s-1.346 3-3 3-3-1.346-3-3 1.346-3 3-3zm0-2c-2.761 0-5 2.239-5 5s2.239 5 5 5 5-2.239 5-5-2.239-5-5-5z" />
                        </svg>
                    </button>
                    <button id="mic-btn" class="active">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path
                                d="M12 2c1.103 0 2 .897 2 2v7c0 1.103-.897 2-2 2s-2-.897-2-2v-7c0-1.103.897-2 2-2zm0-2c-2.209 0-4 1.791-4 4v7c0 2.209 1.791 4 4 4s4-1.791 4-4v-7c0-2.209-1.791-4-4-4zm8 9v2c0 4.418-3.582 8-8 8s-8-3.582-8-8v-2h2v2c0 3.309 2.691 6 6 6s6-2.691 6-6v-2h2zm-7 13v-2h-2v2h-4v2h10v-2h-4z" />
                        </svg>
                    </button>
                    <button id="screen-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M0 1v17h24v-17h-24zm22 15h-20v-13h20v13zm-6.599 4l2.599 3h-12l2.599-3h6.802z" />
                        </svg>
                    </button>
                    <button id="leave-btn" style="background-color: #FF5050;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M16 10v-5l8 7-8 7v-5h-8v-4h8zm-16-8v20h14v-2h-12v-16h12v-2h-14z" />
                        </svg>
                    </button>
                    {{-- End stream and show only to admin --}}
                    @if(Auth::user()->id == $livestream->mentor_id)
                    <a href="{{url('/delete/livestream')}}/{{$livestream->id}}" style="text-decoration: none" id="end-stream-btn" style="background-color: #FF5050;">
                        End Stream
                    </a>
                    @endif

                </div>
                @if(Auth::user()->id == $livestream->mentor_id)
                <button id="join-btn">Join Stream</button>
                @endif
               
            </section>

            <section id="messages__container">

                <div id="messages"></div>

                <form id="message__form">
                    <input type="text" name="message" placeholder="Send a message...." />
                </form>

            </section>
        </div>
    </main>

</body>
<script type="text/javascript" src="{{url('livestream_resources/js/AgoraRTC_N-4.11.0.js')}}"></script>
<script type="text/javascript" src="{{url('livestream_resources/js/agora-rtm-sdk-1.4.4.js')}}"></script>
<script>
    function monitorStreamsContainer() {
    const container = document.getElementById('streams__container');

    // Create a MutationObserver to observe changes in the container
    const observer = new MutationObserver((mutationsList) => {
        for (const mutation of mutationsList) {
            if (mutation.type === 'childList') {
                for (const addedNode of mutation.addedNodes) {
                    // Check if the added node already exists in the container
                    const existingNode = container.querySelector(`#${addedNode.id}`);
                    if (existingNode && existingNode !== addedNode) {
                        // If the node already exists, remove the newly added duplicate
                        container.removeChild(addedNode);
                    }
                }
            }
        }
    });

    // Configure the observer to watch for child additions in the container
    observer.observe(container, { childList: true });
}

// Call the function to start monitoring the streams container
monitorStreamsContainer();
    // room.js
    let messagesContainer = document.getElementById('messages');
    messagesContainer.scrollTop = messagesContainer.scrollHeight;

    const memberContainer = document.getElementById('members__container');
    const memberButton = document.getElementById('members__button');

    const chatContainer = document.getElementById('messages__container');
    const chatButton = document.getElementById('chat__button');

    let activeMemberContainer = false;

    memberButton.addEventListener('click', () => {
        if (activeMemberContainer) {
            memberContainer.style.display = 'none';
        } else {
            memberContainer.style.display = 'block';
        }

        activeMemberContainer = !activeMemberContainer;
    });

    let activeChatContainer = false;

    chatButton.addEventListener('click', () => {
        if (activeChatContainer) {
            chatContainer.style.display = 'none';
        } else {
            chatContainer.style.display = 'block';
        }

        activeChatContainer = !activeChatContainer;
    });

    let displayFrame = document.getElementById('stream__box')
    let videoFrames = document.getElementsByClassName('video__container')
    let userIdInDisplayFrame = null;

    let expandVideoFrame = (e) => {

        let child = displayFrame.children[0]
        if (child) {
            document.getElementById('streams__container').appendChild(child)
        }

        displayFrame.style.display = 'block'
        displayFrame.appendChild(e.currentTarget)
        userIdInDisplayFrame = e.currentTarget.id

        for (let i = 0; videoFrames.length > i; i++) {
            if (videoFrames[i].id != userIdInDisplayFrame) {
                videoFrames[i].style.height = '100px'
                videoFrames[i].style.width = '100px'
            }
        }

    }

    for (let i = 0; videoFrames.length > i; i++) {
        videoFrames[i].addEventListener('click', expandVideoFrame)
    }


    let hideDisplayFrame = () => {
        userIdInDisplayFrame = null
        displayFrame.style.display = null

        let child = displayFrame.children[0]
        document.getElementById('streams__container').appendChild(child)

        for (let i = 0; videoFrames.length > i; i++) {
            videoFrames[i].style.height = '300px'
            videoFrames[i].style.width = '300px'
        }
    }

    displayFrame.addEventListener('click', hideDisplayFrame)
</script>
<script>
    // room_rtm.js
    let handleMemberJoined = async (MemberId) => {
        console.log('A new member has joined the room:', MemberId)
        addMemberToDom(MemberId)
        console.log('Member joined:', MemberId)

        let members = await channel.getMembers()
        updateMemberTotal(members)

        let {
            name
        } = await rtmClient.getUserAttributesByKeys(MemberId, ['name'])
        addBotMessageToDom(`Welcome to the room ${name}! 👋`)
    }

    let addMemberToDom = async (MemberId) => {
        let {
            name
        } = await rtmClient.getUserAttributesByKeys(MemberId, ['name'])

        let membersWrapper = document.getElementById('member__list')
        let memberItem = `<div class="member__wrapper" id="member__${MemberId}__wrapper">
                        <span class="green__icon"></span>
                        <p class="member_name">${name}</p>
                    </div>`

        membersWrapper.insertAdjacentHTML('beforeend', memberItem)
    }

    let updateMemberTotal = async (members) => {
        let total = document.getElementById('members__count')
        total.innerText = members.length
    }

    let handleMemberLeft = async (MemberId) => {
        removeMemberFromDom(MemberId)
        //if leaving user is creator of stream and he left the stream delete the stream api
        if (createdby == MemberId) {
            //delete stream  api/livestream/delete/{id}

            let url = "{{url('api/delete/livestream/{id}')}}"+"/"+'{{$livestream->id}}';

            fetch(url, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            })

            leaveChannel()
        }

        let members = await channel.getMembers()
        updateMemberTotal(members)
    }

    let removeMemberFromDom = async (MemberId) => {
        let memberWrapper = document.getElementById(`member__${MemberId}__wrapper`)
        let name = memberWrapper.getElementsByClassName('member_name')[0].textContent
        addBotMessageToDom(`${name} has left the room.`)


        memberWrapper.remove()
    }

    let getMembers = async () => {
        let members = await channel.getMembers()
        updateMemberTotal(members)
        for (let i = 0; members.length > i; i++) {
            addMemberToDom(members[i])
        }
    }

    let handleChannelMessage = async (messageData, MemberId) => {
        console.log('A new message was received')
        let data = JSON.parse(messageData.text)

        if (data.type === 'chat') {
            addMessageToDom(data.displayName, data.message)
        }

        if (data.type === 'user_left') {
            document.getElementById(`user-container-${data.uid}`).remove()

            if (userIdInDisplayFrame === `user-container-${uid}`) {
                displayFrame.style.display = null

                for (let i = 0; videoFrames.length > i; i++) {
                    videoFrames[i].style.height = '300px'
                    videoFrames[i].style.width = '300px'
                }
            }
        }
    }

    let sendMessage = async (e) => {
        e.preventDefault()

        let message = e.target.message.value
        channel.sendMessage({
            text: JSON.stringify({
                'type': 'chat',
                'message': message,
                'displayName': displayName
            })
        })
        addMessageToDom(displayName, message)
        e.target.reset()
    }

    let addMessageToDom = (name, message) => {
        let messagesWrapper = document.getElementById('messages')

        let newMessage = `<div class="message__wrapper">
                        <div class="message__body">
                            <strong class="message__author">${name}</strong>
                            <p class="message__text">${message}</p>
                        </div>
                    </div>`

        messagesWrapper.insertAdjacentHTML('beforeend', newMessage)

        let lastMessage = document.querySelector('#messages .message__wrapper:last-child')
        if (lastMessage) {
            lastMessage.scrollIntoView()
        }
    }


    let addBotMessageToDom = (botMessage) => {
        let messagesWrapper = document.getElementById('messages')

        let newMessage = `<div class="message__wrapper">
                        <div class="message__body__bot">
                            <strong class="message__author__bot">🤖 Pathway Whispers</strong>
                            <p class="message__text__bot">${botMessage}</p>
                        </div>
                    </div>`

        messagesWrapper.insertAdjacentHTML('beforeend', newMessage)

        let lastMessage = document.querySelector('#messages .message__wrapper:last-child')
        if (lastMessage) {
            lastMessage.scrollIntoView()
        }
    }

    let leaveChannel = async () => {
        await channel.leave()
        await rtmClient.logout()
    }

    window.addEventListener('beforeunload', leaveChannel)
    let messageForm = document.getElementById('message__form')
    messageForm.addEventListener('submit', sendMessage)
</script>
<script>
    // room_rtc.js
    const APP_ID = '4d677780dc9b43bd8fc7a72f3d91cfbd'

    let uid = '{{Auth::user()->id}}'
    let createdby = '{{$livestream->mentor_id}}'

   

    let token = null;
    let client;

    let rtmClient;
    let channel;

    
    let roomId = '{{$livestream->stream_key}}'


    

    let displayName = '{{Auth::user()->name}}'
    


    let localTracks = []
    let remoteUsers = {}

    let localScreenTracks;
    let sharingScreen = false;

    let joinRoomInit = async () => {
        rtmClient = await AgoraRTM.createInstance(APP_ID)
        await rtmClient.login({
            uid,
            token
        })

        await rtmClient.addOrUpdateLocalUserAttributes({
            'name': displayName
        })

        channel = await rtmClient.createChannel(roomId)
        await channel.join()

        channel.on('MemberJoined', handleMemberJoined)
        channel.on('MemberLeft', handleMemberLeft)
        channel.on('ChannelMessage', handleChannelMessage)

        getMembers()
        addBotMessageToDom(`Welcome to the room ${displayName}! 👋`)

        client = AgoraRTC.createClient({
            mode: 'rtc',
            codec: 'vp8'
        })
        await client.join(APP_ID, roomId, token, uid)

        client.on('user-published', handleUserPublished)
        client.on('user-left', handleUserLeft)
    }

    let joinStream = async () => {
    // Check if the current user is the creator of the stream
    if (uid !== createdby) {
        // User is not the creator, so they can only watch the stream
        return;  // Return early, user cannot join as a broadcaster
    }

    // Hide the join button and display the stream actions
    document.getElementById('join-btn').style.display = 'none';
    document.getElementsByClassName('stream__actions')[0].style.display = 'flex';

    // Create microphone and camera tracks
    localTracks = await AgoraRTC.createMicrophoneAndCameraTracks({}, {
        encoderConfig: {
            width: {
                min: 640,
                ideal: 1920,
                max: 1920
            },
            height: {
                min: 480,
                ideal: 1080,
                max: 1080
            }
        }
    });

    // Add the video container for the user
    let player = `<div class="video__container" id="user-container-${uid}">
                    <div class="video-player" id="user-${uid}"></div>
                  </div>`;

    // Add the player container to the stream container
    document.getElementById('streams__container').insertAdjacentHTML('beforeend', player);
    document.getElementById(`user-container-${uid}`).addEventListener('click', expandVideoFrame);

    // Play the local tracks
    localTracks[1].play(`user-${uid}`);
    console.log(uid);

    // Publish the local tracks if the client is connected
    if (client) {
        await client.publish([localTracks[0], localTracks[1]]);
    }
};

    let switchToCamera = async () => {
        //if there is no .video-player element in the displayFrame, create one
        if (!document.getElementById(`user-${uid}`)) {
            let player = `<div class="video-player" id="user-${uid}"></div>`
            displayFrame.insertAdjacentHTML('beforeend', player)
        }        
        
        

        await localTracks[0].setMuted(true)
        await localTracks[1].setMuted(true)

        document.getElementById('mic-btn').classList.remove('active')
        document.getElementById('screen-btn').classList.remove('active')

        localTracks[1].play(`user-${uid}`)
        await client.publish([localTracks[1]])
    }
// Modify the user published event handler
let handleUserPublished = async (user, mediaType) => {
    // Only subscribe to the user if the user is the creator
    if (user.uid === createdby) {
        await client.subscribe(user, mediaType);

        if (mediaType === 'video') {
            // Create video container for the user
            let player = document.createElement('div');
            player.classList.add('video__container');
            player.id = `user-container-${user.uid}`;
            player.innerHTML = `<div class="video-player" id="user-${user.uid}"></div>`;

            document.getElementById('streams__container').appendChild(player);

            user.videoTrack.play(`user-${user.uid}`);
        }

        if (mediaType === 'audio') {
            user.audioTrack.play();
        }
    }
};

    let handleUserLeft = async (user) => {
        delete remoteUsers[user.uid]
        let item = document.getElementById(`user-container-${user.uid}`)
        if (item) {
            item.remove()
        }

        if (userIdInDisplayFrame === `user-container-${user.uid}`) {
            displayFrame.style.display = null

            let videoFrames = document.getElementsByClassName('video__container')

            for (let i = 0; videoFrames.length > i; i++) {
                videoFrames[i].style.height = '300px'
                videoFrames[i].style.width = '300px'
            }
        }
        //if user is creator of stream and he left the stream delete the stream api
        if (createdby == uid) {
            //delete stream  api/livestream/delete/{id}

            let url = "{{url('api/livestream/delete')}}"+"/"+'{{$livestream->id}}';

            fetch(url, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            })

            leaveChannel()
        }

    }

    let toggleMic = async (e) => {
        let button = e.currentTarget

        if (localTracks[0].muted) {
            await localTracks[0].setMuted(false)
            button.classList.add('active')
        } else {
            await localTracks[0].setMuted(true)
            button.classList.remove('active')
        }
    }

    let toggleCamera = async (e) => {
        let button = e.currentTarget

        console.log(localTracks[1].muted)
        if (localTracks[1].muted) {
            await localTracks[1].setMuted(false)
            button.classList.add('active')
        } else {
            await localTracks[1].setMuted(true)
            button.classList.remove('active')
        }
    }

    let toggleScreen = async (e) => {
        let screenButton = e.currentTarget
        let cameraButton = document.getElementById('camera-btn')

      

        if (!sharingScreen) {
            sharingScreen = true

            screenButton.classList.add('active')
            cameraButton.classList.remove('active')
            cameraButton.style.display = 'none'

            localScreenTracks = await AgoraRTC.createScreenVideoTrack()

            document.getElementById(`user-container-${uid}`).remove()
            displayFrame.style.display = 'block'

            let player = `<div class="video__container" id="user-container-${uid}">
                <div class="video-player" id="user-${uid}"></div>
            </div>`
            // if there is no .video-player element in the displayFrame, create one
            
            displayFrame.insertAdjacentHTML('beforeend', player)
            document.getElementById(`user-container-${uid}`).addEventListener('click', expandVideoFrame)

            userIdInDisplayFrame = `user-container-${uid}`
            localScreenTracks.play(`user-${uid}`)

            await client.unpublish([localTracks[1]])
            await client.publish([localScreenTracks])

            let videoFrames = document.getElementsByClassName('video__container')
            for (let i = 0; videoFrames.length > i; i++) {
                if (videoFrames[i].id != userIdInDisplayFrame) {
                    videoFrames[i].style.height = '100px'
                    videoFrames[i].style.width = '100px'
                }
            }


        } else {
            sharingScreen = false
            cameraButton.style.display = 'block'
            document.getElementById(`user-container-${uid}`).remove()
            await client.unpublish([localScreenTracks])

            switchToCamera()
        }
    }

    let leaveStream = async (e) => {
        e.preventDefault()

        document.getElementById('join-btn').style.display = 'block'
        document.getElementsByClassName('stream__actions')[0].style.display = 'none'

        for (let i = 0; localTracks.length > i; i++) {
            localTracks[i].stop()
            localTracks[i].close()
        }

        await client.unpublish([localTracks[0], localTracks[1]])

        if (localScreenTracks) {
            await client.unpublish([localScreenTracks])
        }

        document.getElementById(`user-container-${uid}`).remove()

        if (userIdInDisplayFrame === `user-container-${uid}`) {
            displayFrame.style.display = null

            for (let i = 0; videoFrames.length > i; i++) {
                videoFrames[i].style.height = '300px'
                videoFrames[i].style.width = '300px'
            }
        }

        channel.sendMessage({
            text: JSON.stringify({
                'type': 'user_left',
                'uid': uid
            })
        })
    }



    document.getElementById('camera-btn').addEventListener('click', toggleCamera)
    document.getElementById('mic-btn').addEventListener('click', toggleMic)
    document.getElementById('screen-btn').addEventListener('click', toggleScreen)
    if(createdby == uid)
    document.getElementById('join-btn').addEventListener('click', joinStream)
    document.getElementById('leave-btn').addEventListener('click', leaveStream)


    joinRoomInit()
</script>




{{-- <script type="text/javascript" src="js/room.js"></script> --}}
{{-- <script type="text/javascript" src="js/room_rtm.js"></script>
<script type="text/javascript" src="js/room_rtc.js"></script> --}}

</html>
