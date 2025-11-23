CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(150),
  email VARCHAR(150) UNIQUE,
  password_hash VARCHAR(255),
  role ENUM('admin','lecturer') DEFAULT 'lecturer'
);

CREATE TABLE courses (
  id INT AUTO_INCREMENT PRIMARY KEY,
  code VARCHAR(32),
  title VARCHAR(255)
);

CREATE TABLE projects (
  id INT AUTO_INCREMENT PRIMARY KEY,
  course_id INT,
  title VARCHAR(255),
  description TEXT,
  FOREIGN KEY (course_id) REFERENCES courses(id)
);

CREATE TABLE rubrics (
  id INT AUTO_INCREMENT PRIMARY KEY,
  course_id INT,
  title VARCHAR(255),
  FOREIGN KEY (course_id) REFERENCES courses(id)
);

CREATE TABLE rubric_criteria (
  id INT AUTO_INCREMENT PRIMARY KEY,
  rubric_id INT,
  title VARCHAR(255),
  max_score DECIMAL(5,2),
  FOREIGN KEY (rubric_id) REFERENCES rubrics(id)
);

CREATE TABLE grades (
  id INT AUTO_INCREMENT PRIMARY KEY,
  project_id INT,
  rubric_id INT,
  grader_id INT,
  total_score DECIMAL(6,2),
  UNIQUE (project_id, grader_id, rubric_id)
);

CREATE TABLE grade_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  grade_id INT,
  rubric_criteria_id INT,
  score DECIMAL(6,2),
  comment TEXT
);
