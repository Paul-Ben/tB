<?php

namespace App\Mail;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TeacherAccountCreated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $teacher;
    public $user;
    public $temporaryPassword;

    /**
     * Create a new message instance.
     */
    public function __construct(Teacher $teacher, User $user, string $temporaryPassword)
    {
        $this->teacher = $teacher;
        $this->user = $user;
        $this->temporaryPassword = $temporaryPassword;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome to ' . config('app.name') . ' - Your Teacher Account Has Been Created',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.teacher-account-created',
            with: [
                'teacherName' => $this->teacher->full_name,
                'email' => $this->user->email,
                'password' => $this->temporaryPassword,
                'loginUrl' => route('login'),
                'appName' => config('app.name'),
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}