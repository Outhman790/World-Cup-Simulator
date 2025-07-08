# 🌍 World Cup Simulator

A PHP-based web application that simulates World Cup group stage matches with real-time leaderboard generation and advanced tie-breaking rules.

## 📋 Features

### 🏆 Core Functionality

- **Match Score Input**: Enter scores for each team using large, user-friendly number inputs
- **Real-time Leaderboard**: Automatically generates and displays team rankings
- **Advanced Tie-breaking**: Implements FIFA-style tie-breaking rules
- **Game State Management**: Tracks which matches have been played
- **Reset Functionality**: Clear all scores and start fresh

### 🎨 User Interface

- **Bootstrap 5.3.0**: Modern, responsive design
- **Visual Feedback**: Clear indicators for played matches
- **Intuitive Layout**: Easy-to-use score input system
- **Professional Styling**: Custom CSS with team colors and modern design

### 📊 Leaderboard Features

The leaderboard displays comprehensive statistics for each team:

- **Position**: Current ranking
- **Team Name**: Country/team identifier
- **Points**: Total points earned (3 for win, 1 for draw, 0 for loss)
- **Games Played**: Number of completed matches
- **Games Won**: Number of victories
- **Games Equal**: Number of draws
- **Games Lost**: Number of defeats
- **Goals Scored**: Total goals scored
- **Goals Received**: Total goals conceded
- **Goal Difference**: Goals scored minus goals received

## 🏅 Tie-Breaking Rules

The simulator implements official FIFA tie-breaking criteria in order:

1. **Points**: Higher total points
2. **Goal Difference**: Higher goal difference (goals scored - goals received)
3. **Goals Scored**: Higher number of goals scored
4. **Head-to-Head**: Results between tied teams
   - Points in head-to-head matches
   - Goal difference in head-to-head matches
   - Goals scored in head-to-head matches

## 🛠️ Technical Requirements

### Server Requirements

- **PHP**: 7.4 or higher
- **Web Server**: Apache, Nginx, or XAMPP
- **Browser**: Modern web browser with JavaScript enabled

### Dependencies

- **Bootstrap**: 5.3.0 (loaded via CDN)
- **PHP**: Built-in functions only, no external libraries required

## 📁 Project Structure

```
World-Cup-Simulator/
├── index.php          # Main application file
├── functions.php      # PHP functions for calculations
├── style.css          # Custom styling
└── README.md          # This file
```

## 🚀 Installation

### Option 1: XAMPP (Recommended)

1. Download and install [XAMPP](https://www.apachefriends.org/)
2. Place the project folder in `htdocs` directory
3. Start Apache server in XAMPP Control Panel
4. Access via `http://localhost/World-Cup-Simulator/`

### Option 2: Other Web Servers

1. Place project files in your web server's document root
2. Ensure PHP is installed and configured
3. Access via your web server's URL

## 🎮 How to Use

### 1. Enter Match Scores

- Navigate to the main page
- For each match, enter scores in the number input fields
- Click "Play" to save the scores
- Played matches will show a green checkmark

### 2. Generate Leaderboard

- After entering scores, click the "Simulate" button
- The leaderboard will display with all teams ranked according to FIFA rules
- Teams are automatically sorted by points, goal difference, and goals scored

### 3. Reset All Games

- Click "Reset all games" to clear all scores
- This will reset the leaderboard to default state

## 🏟️ Current Teams

The simulator includes four teams:

- **MOROCCO** 🇲🇦
- **BRASIL** 🇧🇷
- **CANADA** 🇨🇦
- **SPAIN** 🇪🇸

## 📝 Technical Details

### Data Storage

- Uses browser cookies to persist game data
- No database required
- Data is stored as JSON in cookies

### Algorithm Implementation

- **createTeams()**: Processes match results and calculates statistics
- **sortTable()**: Implements tie-breaking rules for ranking
- **getTheOposite()**: Helper function for finding opposing team

### Security Features

- Input validation for score ranges (0-99)
- Type casting to prevent injection
- Form validation and sanitization

### Screenshots
