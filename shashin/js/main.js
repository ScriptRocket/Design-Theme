const portfolioPostsBtn = document.getElementById("portfolio-posts-btn");
const portfolioPostsContainer = document.getElementById("portfolio-posts-container");


if (portfolioPostsBtn) {
    portfolioPostsBtn.addEventListener("click", function () {
        const ourRequest = new XMLHttpRequest();
        ourRequest.open('GET', 'http://localhost/wordpress/wordpress/wp-json/wp/v2/posts?categories=1&order=asc');
        ourRequest.onload = function () {
            if (ourRequest.status >= 200 && ourRequest.status < 400) {
                const data = JSON.parse(ourRequest.responseText);
                createHTML(data);
                portfolioPostsBtn.remove();
            } else {
                console.log("We connected to the server, but it returned an error.");
            }
        };

        ourRequest.onerror = function () {
            console.log("Connection error");
        };

        ourRequest.send();
    });
}

const createHTML = (postData) => {
    let ourHTMLString = '';

    for(let i= 0; i<postData.length; i++){
        ourHTMLString += '<h2>' + postData[i].title.rendered +'</h2>';
        ourHTMLString += postData[i].content.rendered;
    }
    portfolioPostsContainer.innerHTML = ourHTMLString;

}

//Quick Add Post AJAX
const quickAddButton = document.querySelector("#quick-add-button");

if(quickAddButton){
    quickAddButton.addEventListener("click", function(){
        const ourPostData = {
            "title" : document.querySelector('.admin-quick-add [name="title"]').value,
            "content" : document.querySelector('.admin-quick-add [name="content"]').value,
            "status" : "publish"
        }

        const createPost = new XMLHttpRequest();
        createPost.open("POST", "http://localhost/wordpress/wordpress/wp-json/wp/v2/posts");
        createPost.setRequestHeader('X-WP-Nonce', passingData.nonce);
        createPost.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        createPost.send(JSON.stringify(ourPostData));
        
        createPost.onreadystatechange = () => {
            if(createPost.readyState == 4){
                if(createPost.status == 201){
                    document.querySelector('.admin-quick-add [name="title"]').value = '';
                    document.querySelector('.admin-quick-add [name="content"]').value = '';
                }else{
                    alert('Error - try again');
                }
            }
        }
    });
}