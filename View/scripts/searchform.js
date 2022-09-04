let inputEl = document.querySelector(".search__input");
let formEl = document.querySelector(".search__form");
let foundSection = document.querySelector(".found");
let alertEl = document.querySelector(".alert");

function updateHtmlSearchResult(data){

    foundSection.innerHTML = "";
    if(data.body.length === 0){
        updateAlert("Ничего не найденно");

    }else{
        let countComments = 0;
        for (let key in data.body) {

            const postFound = data.body[key];
            const comments = postFound.comments;
            countComments += comments.length;
            //Создание разметки комментариев
            let commentsHtml = "";
            comments.forEach((comment)=>{
                commentsHtml += 
                `
                <div class="found__comment">
                <h4 class="found__comment_id">
                   Комментарий № ${comment.id}
                </h4>
                <p class="found__comment_name">
                    <b>Название: ${comment.name}</b>  
                </p>
                <p class="found__comment_email">
                    <b>Email: ${comment.email}</b> 
                </p>
                <p class="found__comment_body">
                   <b>Текст: ${comment.body}</b> 
                </p>
                </div>
                `;
               
            });
            
            //Вставка полной записи в html
            foundSection.innerHTML += 
            `
            <div class="found__post">
            <h2 class="found__post_id">
               Запись № ${key}
            </h2>
            <h2 class="found__post_title">
               Заголовок: ${postFound.post_title}
            </h2>
            <div class="found__comments">
                <h3 class="comments__heading">
                    Найденные комментарии:
                </h3>
                ${commentsHtml}
            </div>
        </div>
            `;
         
        }
        updateAlert(`Комментариев найдено: ${countComments}`);

    }
}

function updateAlert(newValue){
    alertEl.innerHTML = newValue;
}

function getSearchData(searchStr){

    fetch(`/api/SearchApi.php/?api=search&search=${searchStr}`)
        .then((response)=>{
            return response.json();
        })
        .then((data)=>{

            if(data.status === 200){
                updateHtmlSearchResult(data);

            }else if(data.status === 500){
                 updateAlert(data.body);
            }
        });
}

formEl.addEventListener("submit", (event)=>{
    event.preventDefault();

    let value = inputEl.value;
    if(value.length < 3){
        alertEl.innerHTML = "Поисковой запрос должен быть не менее 3 символов";
    }else{
        getSearchData(value);
    }
    
});
