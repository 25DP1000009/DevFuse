<button id="interestedButton" 
        data-project-id="<?php echo $project_id; ?>" 
        data-owner-email="<?php echo $project_owner_email; ?>" 
        class="btn btn-primary">
    I'm Interested
</button>

<!-- Modal for Sending a Message -->
<div id="messageModal" class="modal" style="display:none;">
  <form action="../scripts/send-message.php" method="POST">
    <input type="hidden" name="project_id" id="project_id">
    <input type="hidden" name="receiver_email" id="receiver_email">
    <textarea name="message_content" rows="5" placeholder="Write your message..." required></textarea>
    <button type="submit" class="btn btn-success">Send Message</button>
  </form>
</div>
