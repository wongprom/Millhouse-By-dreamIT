<?php if (empty($latestPost)): ?>
    <div class="message">
        <p class="message__if-empty">
            You haven't published anything yet! 
            If you need some help creating a post
            <a class="message__link" href="pages/help.php">
                click here to find our FAQ
            </a>
        </p>
    </div>
<?php endif; ?>