<?php include 'header.php'; ?>
<head>
    <meta charset="UTF-8">
    <title>Nipa | Home</title>
    <link rel="stylesheet" href="contact.css">
</head>
<section class="contact-page">
    <div class="contact-hero">
        <h2>Get in Touch</h2>
        <p>We’d love to hear from you. Whether you have a question or just want to say hi.</p>
    </div>

    <div class="contact-container">
        <div class="contact-info">
            <h3>Contact Details</h3>
            <p><strong>Address:</strong> 123 Fashion Street, Lagos, Nigeria</p>
            <p><strong>Email:</strong> support@nipa.com</p>
            <p><strong>Phone:</strong> +234 800 123 4567</p>
        </div>

        <form class="contact-form" action="send_message.php" method="POST">
            <input type="text" name="name" placeholder="Your Name" required />
            <input type="email" name="email" placeholder="Your Email" required />
            <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
            <button type="submit">Send Message</button>
        </form>
    </div>
</section>

<?php include 'footer.php'; ?>
