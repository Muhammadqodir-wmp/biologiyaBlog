<?php
$titleSarlavha = "Quiz";

require "includes/header.php";
require "database.php";

// Savollarni olish
$statement = $pdo->prepare("SELECT * FROM questions");
$statement->execute();
$questions = $statement->fetchAll(PDO::FETCH_ASSOC);

// Natijalarni tekshirish (foydalanuvchi yuborganidan keyin)
$score = 0;
$totalQuestions = count($questions);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($questions as $question) {
        $qid = $question['id'];
        if (isset($_POST["q$qid"]) && $_POST["q$qid"] === $question['correct_option']) {
            $score++;
        }
    }
}

?>

<div class="quiz-container">
    <h1>Quiz App</h1>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <div class="result">
            <h2>Natijangiz:</h2>
            <p>Sizning ballingiz: <?= $score; ?> / <?= $totalQuestions; ?></p>
            <a href="quiz.php">Yana urinib ko'ring</a>
        </div>
    <?php else: ?>
        <form action="quiz.php" method="POST">
            <?php foreach ($questions as $index => $question): ?>
                <div class="question">
                    <p><strong><?= ($index + 1) . ". " . $question['question']; ?></strong></p>
                    <label>
                        <input type="radio" name="q<?= $question['id']; ?>" value="A"> <?= $question['option_a']; ?>
                    </label><br>
                    <label>
                        <input type="radio" name="q<?= $question['id']; ?>" value="B"> <?= $question['option_b']; ?>
                    </label><br>
                    <label>
                        <input type="radio" name="q<?= $question['id']; ?>" value="C"> <?= $question['option_c']; ?>
                    </label><br>
                    <label>
                        <input type="radio" name="q<?= $question['id']; ?>" value="D"> <?= $question['option_d']; ?>
                    </label><br>
                </div>
            <?php endforeach; ?>
            <button type="submit">Yuborish</button>
        </form>
    <?php endif; ?>
</div>

<?php require "includes/footer.php"; ?>
