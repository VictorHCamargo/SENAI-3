const storyModalEl = document.getElementById('storyModal');
const storyProfileImg = document.getElementById('storyProfileImg');
const storyUsername = document.getElementById('storyUsername');
const storyProgressContainer = document.getElementById('storyProgressContainer');
const storyItems = document.querySelectorAll('.story-item');

let currentStoryIndex = 0;
let storyTimer;
let progressAnimation;
const STORY_DURATION = 5000; 

storyItems.forEach((item, index) => {
    item.addEventListener('click', () => {
        openStory(index);
    });
});

function buildProgressBars() {
    storyProgressContainer.innerHTML = '';
    storyItems.forEach(() => {
        const bar = document.createElement('div');
        bar.className = 'story-progress-bar';
        const fill = document.createElement('div');
        fill.className = 'story-progress-fill';
        bar.appendChild(fill);
        storyProgressContainer.appendChild(bar);
    });
}

function updateProgressUI(index) {
    const bars = document.querySelectorAll('.story-progress-fill');
    bars.forEach((bar, i) => {
        if (i < index) {
            bar.style.width = '100%';
            bar.style.transition = 'none';
        } else if (i > index) {
            bar.style.width = '0%';
            bar.style.transition = 'none';
        }
    });
}

function startStoryTimer(index) {
    clearTimeout(storyTimer);
    cancelAnimationFrame(progressAnimation);
    
    const bars = document.querySelectorAll('.story-progress-fill');
    const currentBar = bars[index];
    currentBar.style.width = '0%';
    
    let startTime = null;
    
    function animateProgress(timestamp) {
        if (!startTime) startTime = timestamp;
        const runtime = timestamp - startTime;
        let progress = (runtime / STORY_DURATION) * 100;
        
        if (progress < 100) {
            currentBar.style.width = `${progress}%`;
            progressAnimation = requestAnimationFrame(animateProgress);
        } else {
            currentBar.style.width = '100%';
        }
    }
    
    progressAnimation = requestAnimationFrame(animateProgress);
    
    storyTimer = setTimeout(() => {
        nextStory();
    }, STORY_DURATION);
}

function openStory(index) {
    if (index < 0 || index >= storyItems.length) {
        closeStoryModal();
        return;
    }
    
    currentStoryIndex = index;
    buildProgressBars();
    updateProgressUI(index);
    
    const userImg = storyItems[index].querySelector('img').src;
    const userName = storyItems[index].querySelector('.story-user').innerText;
    
    storyProfileImg.src = userImg;
    storyUsername.innerText = userName;
    
    storyItems[index].querySelector('.story-ring').classList.add('viewed');
    storyItems[index].querySelector('.story-ring').classList.remove('close-friends');
    
    storyModalEl.classList.add('active');
    startStoryTimer(index);
}

function nextStory() {
    openStory(currentStoryIndex + 1);
}

function prevStory() {
    if (currentStoryIndex > 0) {
        openStory(currentStoryIndex - 1);
    } else {
        openStory(0);
    }
}

function closeStoryModal() {
    storyModalEl.classList.remove('active');
    clearTimeout(storyTimer);
    cancelAnimationFrame(progressAnimation);
}