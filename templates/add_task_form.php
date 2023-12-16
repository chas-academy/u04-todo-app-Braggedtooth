<div class="card is-flex-grow-1 mx-4">
    <form method="POST" >
        <div class="card-header">
            <h1 class="card-header-title"> Add Task </h1>
        </div>
        <div class="card-content">
            <div class="field">
                <label for="addtodo" class="label">New Task</label>
                <input class="input " id="addtodo" type="text" placeholder="Task Name" name="todo_item" autofocus required>
            </div>
            <div class="field">
                <label for="addtododesc" class="label">Description</label>
                <textarea class="textarea has-fixed-size" id="todo_desc" type="text" placeholder="Todo Description" name="todo_desc"> </textarea>
            </div>

            <div class="field has-text-right">
            <button name="submit" type="submit" class="button is-link">Submit</button> 
            </div>
        </div>
    </form>
</div>