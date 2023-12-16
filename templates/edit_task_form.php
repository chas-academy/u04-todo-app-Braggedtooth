<div class="card is-flex-grow-1  mx-4">
     <form  method="POST">
        <div class="card-header"> 
                <h1 class="card-header-title"> Edit Task </h1>
                </div>
                <div class="card-content"> 
                <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                <div class="field">
                    <label for="addtodo" class="label"> Task Name</label>
                    <input class="input" id="todo_item" type="text" placeholder="Edit Todo"
                        value="<?php echo $title; ?> " name="todo_item" required>
                </div>
                <div class="field">
                    <label for="todoDesc" class="label">Description</label>
                    <textarea class="textarea has-fixed-size" id="todoDesc" type="text"
                        placeholder="Change Description" name="todoDesc"><?php echo $description; ?></textarea>
                </div>
                <div class="field has-text-right">
                        <button name="update" type="submit" class="button is-link"
                        <?php echo $updatebtn; ?>>Update</button>
                    </div>
                </div>
            </form>

     </div>