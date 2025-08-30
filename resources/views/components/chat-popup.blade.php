

<div id="chatPopupBox"
     class="card position-fixed bottom-0 end-0 m-4 shadow-lg border-0"
     style="width: 320px; display: none; z-index: 9995; border-radius: 12px;">
     <div class="card-header bg-primary text-white py-2 px-3 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <img id="chatBusinessLogo" src="" alt="Logo" style="width: 32px; height: 32px; object-fit: cover; border-radius: 6px; background: #fff;">
            <span id="chatBusinessName" class="fw-semibold">Chat</span>
        </div>
        <button class="btn-close btn-close-white btn-sm" onclick="closeChatPopup()"></button>
    </div>
    <div class="card-body p-3" style="height: 200px; overflow-y: auto;" id="chatMessages">
        <div class="text-muted small">Select a business to start chatting.</div>
    </div>
    <div class="card-footer p-2 border-top d-flex">
        <input type="text" class="form-control form-control-sm me-2" placeholder="Type message..." id="chatInput">
        <button class="btn btn-sm btn-primary">Send</button>
    </div>
</div>