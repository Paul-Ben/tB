<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to {{ $appName }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .content {
            padding: 30px 20px;
        }
        .credentials-box {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 6px;
            padding: 20px;
            margin: 20px 0;
        }
        .credentials-item {
            margin: 10px 0;
        }
        .credentials-label {
            font-weight: bold;
            color: #495057;
        }
        .credentials-value {
            font-family: monospace;
            background: #fff;
            padding: 8px 12px;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            margin-top: 5px;
            display: block;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
        .btn:hover {
            background: #0056b3;
        }
        .warning-box {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 6px;
            padding: 15px;
            margin: 20px 0;
            border-left: 4px solid #f39c12;
        }
        .footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #6c757d;
            font-size: 14px;
        }
        .welcome-icon {
            font-size: 48px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="welcome-icon">🎓</div>
            <h1>Welcome to {{ $appName }}!</h1>
            <p>Your teacher account has been successfully created</p>
        </div>
        
        <div class="content">
            <h2>Hello {{ $teacherName }},</h2>
            
            <p>We're excited to welcome you to {{ $appName }}! Your teacher account has been created by the administration team, and you can now access the platform to manage your classes and students.</p>
            
            <div class="credentials-box">
                <h3 style="margin-top: 0; color: #495057;">📋 Your Login Credentials</h3>
                
                <div class="credentials-item">
                    <div class="credentials-label">Email Address:</div>
                    <span class="credentials-value">{{ $email }}</span>
                </div>
                
                <div class="credentials-item">
                    <div class="credentials-label">Temporary Password:</div>
                    <span class="credentials-value">{{ $password }}</span>
                </div>
            </div>
            
            <div class="warning-box">
                <strong>🔒 Important Security Notice:</strong>
                <p style="margin: 10px 0 0 0;">This is a temporary password. For your account security, please change your password immediately after your first login. You can do this by going to your profile settings.</p>
            </div>
            
            <h3>🚀 Getting Started</h3>
            <ol>
                <li><strong>Login:</strong> Use the credentials above to access your account</li>
                <li><strong>Change Password:</strong> Update your password in profile settings</li>
                <li><strong>Complete Profile:</strong> Fill in your teacher profile information</li>
                <li><strong>Explore Features:</strong> Familiarize yourself with the teacher dashboard</li>
            </ol>
            
            <div style="text-align: center;">
                <a href="{{ $loginUrl }}" class="btn">Login to Your Account</a>
            </div>
            
            <h3>🎯 What You Can Do</h3>
            <ul>
                <li>Manage your classes and student assignments</li>
                <li>Track student progress and performance</li>
                <li>Communicate with students and parents</li>
                <li>Access teaching resources and materials</li>
                <li>Generate and view reports</li>
            </ul>
            
            <p>If you have any questions or need assistance getting started, please don't hesitate to contact the administration team or IT support.</p>
            
            <p>We're thrilled to have you as part of our educational team!</p>
            
            <p>Best regards,<br>
            <strong>{{ $appName }} Administration Team</strong></p>
        </div>
        
        <div class="footer">
            <p>This email was sent automatically by {{ $appName }}. If you believe you received this email in error, please contact the administration immediately.</p>
            <p>&copy; {{ date('Y') }} {{ $appName }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>