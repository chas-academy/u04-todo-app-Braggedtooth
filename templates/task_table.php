<!-- templates/task_table.php -->
<script>
    window.onload = function() {
        const tableContainer = document.getElementById('scroll-container');
        const clickedRow = document.getElementById('row<?php echo $_SESSION['clickedRow']; ?>');
        if (clickedRow) {
            tableContainer.scrollTop = clickedRow.offsetTop;
            console.log(clickedRow.offsetTop);
        }
    }
</script>

<table class="table is-fullwidth card ">
    <thead>
        <tr>
            <th>ID</th>
            <th>Task</th>
            <th>Description</th>
            <th>Date</th>
            <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody class="card-content">
        <?php foreach ($rows as $row) : ?>
            <tr id="row<?php echo $row['id']; ?>"  class="<?php echo ('row'.$_SESSION['clickedRow'] == 'row' . $row['id']) ? 'has-background-grey-light' : ''; ?>">
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['todo_item']; ?></td>
                <td>
                    <div style="word-wrap: break-word;"><?php echo $row['todo_desc']; ?></div>
                </td>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['complete'] == "1" ? 'Complete' : 'Incomplete'; ?></td>
                <td>
                    <div style="word-wrap: break-word;">
                        <div class="is-flex-direction-row is-flex" style="gap:4px">
                            <a href="index.php?edit=<?php echo $row['id']; ?>" class="button is-link is-light is-small">Edit</a>
                            <a href="index.php?delete=<?php echo $row['id']; ?>" class="button is-danger is-light is-small">Delete</a>

                         <?php if ($row['complete'] == "1") {
                                echo "<a href=\"index.php?complete=" . $row['id'] . "\" class=\"button is-warning is-light is-small\" >Undo</a>";
                            } else {
                                echo "<a href=\"index.php?complete=" . $row['id'] . "\" class=\"button is-success is-light is-small\">Complete</a>";
                            } ?>
                        
                        </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>