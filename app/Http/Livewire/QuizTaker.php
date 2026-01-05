<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\UserProgress;
use Illuminate\Support\Facades\Auth;

class QuizTaker extends Component
{
    public $quizId;
    public $quiz;
    public $currentQuestionIndex = 0;
    public $userAnswers = [];
    public $score = 0;
    public $isFinished = false;
    public $passed = false;

    // Timer
    public $startTime;
    public $timeLimit = 900;
    public $timeTaken = 0;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount($quizId)
    {
        $this->quizId = $quizId;
        $this->quiz = Quiz::findOrFail($quizId);
        $this->startTime = time();
    }

    public function getQuestionsProperty()
    {
        return Question::where('quiz_id', $this->quizId)->get();
    }

    public function getRemainingTimeProperty()
    {
        if ($this->isFinished)
            return 0;
        $elapsed = time() - $this->startTime;
        return max(0, $this->timeLimit - $elapsed);
    }

    public function getCurrentQuestionProperty()
    {
        return $this->questions[$this->currentQuestionIndex] ?? null;
    }

    public function selectAnswer($questionId, $optionKey)
    {
        $this->userAnswers[$questionId] = $optionKey;
    }

    public function nextQuestion()
    {
        if ($this->currentQuestionIndex < $this->questions->count() - 1) {
            $this->currentQuestionIndex++;
        }
    }

    public function prevQuestion()
    {
        if ($this->currentQuestionIndex > 0) {
            $this->currentQuestionIndex--;
        }
    }

    public function submit()
    {
        if ($this->isFinished)
            return;

        $this->timeTaken = time() - $this->startTime;

        $correctCount = 0;
        $questions = $this->questions;

        foreach ($questions as $question) {
            if (
                isset($this->userAnswers[$question->id]) &&
                $this->userAnswers[$question->id] == $question->correct_answer
            ) {
                $correctCount++;
            }
        }

        $total = $questions->count();
        $this->score = $total > 0 ? round(($correctCount / $total) * 100) : 0;
        $this->passed = $this->score >= ($this->quiz->passing_score ?? 75);
        $this->isFinished = true;

        UserProgress::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'content_type' => Quiz::class,
                'content_id' => $this->quizId,
            ],
            [
                'status' => $this->passed ? 'completed' : 'failed',
                'score' => $this->score,
            ]
        );
    }

    public function render()
    {
        return view('livewire.quiz-taker');
    }
}
