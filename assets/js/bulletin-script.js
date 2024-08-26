// bulletin-board.js
document.addEventListener('DOMContentLoaded', loadBulletinBoard);

function loadBulletinBoard() {
    fetch('/api/get-messages') // Adjust endpoint based on your setup
        .then(response => response.json())
        .then(data => {
            const board = document.getElementById('bulletin-board');
            board.innerHTML = '';
            data.messages.forEach(msg => {
                const div = document.createElement('div');
                div.className = 'bulletin-message';
                div.innerHTML = `
                    <p>${msg.text}</p>
                    ${msg.image ? `<img src="${msg.image}" alt="Bulletin Image">` : ''}
                `;
                board.appendChild(div);
            });
        });
}