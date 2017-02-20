<form id="userform">
    <div>
        First Name: <input type="text" name="firstname" required />
    </div>
    <div>
        Last Name: <input type="text" name="lastname" required />
    </div>
    <div>
        Email: <input type="email" name="email" required />
    </div>
    <div>
        User Role: 
        <select name="userType" required>
            <option></option>
            <?php
            foreach ($user_types as $type) {
                echo "<option>$type</option>";
            }
            ?>
        </select>
    </div>
    <div>
        User Name: <input type="text" name="username" required />
    </div>
    <div>
        Password: <input type="password" name="pwd1" required />
    </div>
    <div>
        Confirm Password: <input type="password" name="pwd2" required />
    </div>
    <input type="hidden" name="userid" />
    <button class="create">Create</button><br />
    <button class="update" style="display:none;">Update</button><br />
</form>

<a href="/">Home</a>
<div>
    <table border=1>
        <tr>
            <td>First Name</td>
            <td>Last Name</td>
            <td>Email</td>
            <td>User Type</td>
            <td>Username</td>
            <td>Action</td>
        </tr>
        <?php
        if (is_array($users) && !empty($users)) {
            foreach ($users as $user) {
                echo "<tr>";
                echo "<td>".$user['firstname']."</td>";
                echo "<td>".$user['lastname']."</td>";
                echo "<td>".$user['email']."</td>";
                echo "<td>".$user['user_type']."</td>";
                echo "<td>".$user['username']."</td>";
                echo "<td><button data-item='".$user['id']."' class='edit'>Edit</button></td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
</div>
