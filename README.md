# CodeIgniter 4 Application Starter

<details>
  <summary>What is CodeIgniter?</summary>
  <p>
    CodeIgniter is a PHP full-stack web framework that is light, fast, flexible, and secure. 
    More information can be found at the <a href="https://codeigniter.com">official site</a>.
    This repository holds a composer-installable app starter. 
    It has been built from the <a href="https://github.com/codeigniter4/CodeIgniter4">development repository</a>.
    More information about the plans for version 4 can be found in <a href="https://forum.codeigniter.com/forumdisplay.php?fid=28">CodeIgniter 4</a> on the forums.
    You can read the <a href="https://codeigniter.com/user_guide/">user guide</a> corresponding to the latest version of the framework.
  </p>
</details>

<details>
  <summary>Installation & Updates</summary>
  <p>
    Run the following command to create the project:
    <pre><code>composer create-project codeigniter4/appstarter</code></pre>
    Then, update your project whenever there is a new release of the framework:
    <pre><code>composer update</code></pre>
    When updating, check the release notes to see if there are any changes you might need to apply to your <code>app</code> folder. 
    The affected files can be copied or merged from <code>vendor/codeigniter4/framework/app</code>.
  </p>
</details>

<details>
  <summary>Setup</summary>
  <p>
    Copy <code>env</code> to <code>.env</code> and tailor it for your app, specifically the baseURL and any database settings.
  </p>
</details>

<details>
  <summary>Important Change with index.php</summary>
  <p>
    <code>index.php</code> is no longer in the root of the project! It has been moved inside the <em>public</em> folder for better security and separation of components.
    This means that you should configure your web server to "point" to your project's <em>public</em> folder, and not to the project root. 
    A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter <em>public/...</em>, as the rest of your logic and the framework are exposed.
    <strong>Please</strong> read the user guide for a better explanation of how CI4 works!
  </p>
</details>

<details>
  <summary>Repository Management</summary>
  <p>
    We use GitHub issues in our main repository to track <strong>BUGS</strong> and to track approved <strong>DEVELOPMENT</strong> work packages. 
    We use our <a href="http://forum.codeigniter.com">forum</a> to provide <strong>SUPPORT</strong> and to discuss <strong>FEATURE REQUESTS</strong>.
    This repository is a "distribution" one, built by our release preparation script. Problems with it can be raised on our forum or as issues in the main repository.
  </p>
</details>

<details>
  <summary>Server Requirements</summary>
  <p>
    PHP version 8.1 or higher is required, with the following extensions installed:
    <ul>
      <li><a href="http://php.net/manual/en/intl.requirements.php">intl</a></li>
      <li><a href="http://php.net/manual/en/mbstring.installation.php">mbstring</a></li>
    </ul>
    <blockquote>
      <strong>WARNING</strong>
      <ul>
        <li>The end of life date for PHP 7.4 was November 28, 2022.</li>
        <li>The end of life date for PHP 8.0 was November 26, 2023.</li>
        <li>If you are still using PHP 7.4 or 8.0, you should upgrade immediately.</li>
        <li>The end of life date for PHP 8.1 will be December 31, 2025.</li>
      </ul>
    </blockquote>
    Additionally, make sure that the following extensions are enabled in your PHP:
    <ul>
      <li>json (enabled by default - don't turn it off)</li>
      <li><a href="http://php.net/manual/en/mysqlnd.install.php">mysqlnd</a> if you plan to use MySQL</li>
      <li><a href="http://php.net/manual/en/curl.requirements.php">libcurl</a> if you plan to use the HTTP\CURLRequest library</li>
    </ul>
  </p>
</details>

<details>
  <summary>Setting Up the CodeIgniter Project on a Local Machine</summary>
  <p>
    To set up a CodeIgniter 4 project on another local machine, follow these steps:
    <h4>Prerequisites</h4>
    <ol>
      <li>Ensure the following requirements are met before starting:
        <ul>
          <li>PHP: Version 8.1 or higher is required. Check your PHP version with:
          <pre><code>php -v</code></pre>
          </li>
          <li>Required PHP Extensions:
            <ul>
              <li>intl: For internationalization.</li>
              <li>mbstring: For handling multibyte strings.</li>
              <li>json (enabled by default).</li>
              <li>mysqlnd: Needed if using MySQL.</li>
              <li>libcurl: Required if using HTTP\CURLRequest library.</li>
            </ul>
          </li>
          <li>Composer: This is required to manage dependencies. If it is not installed, download it from <a href="https://getcomposer.org">getcomposer.org</a>.</li>
        </ul>
      </li>
    </ol>

    <h4>Step-by-Step Setup Guide</h4>
    <ol>
      <li>
        <strong>Clone or Copy the Project Files</strong>
        <ul>
          <li>If you’re copying a project, transfer all project files to the desired directory on the local machine.</li>
          <li>If using Git, clone the repository:
          <pre><code>git clone &lt;repository_url&gt;<br/>cd &lt;project_directory&gt;</code></pre>
          </li>
        </ul>
      </li>
      <li>
        <strong>Install Dependencies</strong>
        <ul>
          <li>Run the following command to install dependencies:
          <pre><code>composer install</code></pre>
          </li>
          <li>To check for and apply updates to dependencies, run:
          <pre><code>composer update</code></pre>
          </li>
        </ul>
      </li>
      <li>
        <strong>Configure Environment Variables</strong>
        <ul>
          <li>Copy the provided <code>env</code> file to create a <code>.env</code> file in the project’s root directory:
          <pre><code>cp env .env</code></pre>
          </li>
          <li>Open <code>.env</code> and adjust settings based on your environment:
            <ul>
              <li><strong>App Base URL</strong>: Update <code>app.baseURL</code> to reflect the local environment.</li>
              <li><strong>Database</strong>: Configure your database settings under <code>database.default</code> for the local database connection:
              <pre><code>database.default.hostname = localhost<br/>
database.default.database = your_database_name<br/>
database.default.username = your_database_user<br/>
database.default.password = your_database_password<br/>
database.default.DBDriver = MySQLi  # Change if you're using another DB driver</code></pre>
              </li>
            </ul>
          </li>
        </ul>
      </li>
      <li>
        <strong>Set Up the Database</strong>
        <ul>
          <li>If your project includes database migrations or seed files, run these commands to set up the database schema:
          <pre><code>php spark migrate<br/>
php spark db:seed &lt;SeederClassName&gt;  # Optional, if seeder classes are available</code></pre>
          </li>
        </ul>
      </li>
      <li>
        <strong>Set Up Web Server</strong>
        <ul>
          <li>By default, CodeIgniter 4’s <code>index.php</code> is located inside the <em>public</em> folder for security reasons. Point your server’s root directory to this <em>public</em> folder, not the project root.</li>
          <li>If using Apache or Nginx, configure a virtual host to point to the <em>public</em> directory.</li>
          <li>Using PHP’s Built-In Server: If you don’t have a configured web server, you can use PHP’s built-in server for development:
          <pre><code>php spark serve</code></pre>
          By default, this will start the server on <a href="http://localhost:8080">http</a> and you can access the application there.</li>
        </ul>
      </li>
      <li>
        <strong>Verify Permissions</strong>
        <ul>
          <li>Make sure that the writable directory in the project has appropriate write permissions, as CodeIgniter will store cache files, session files, and logs here:
          <pre><code>chmod -R 775 writable/</code></pre>
          </li>
        </ul>
      </li>
      <li>
        <strong>Testing the Application</strong>
        <ul>
          <li>After setting up, navigate to the base URL of the application in your browser (e.g., <a href="http://localhost:8080">http://localhost:8080</a> or your configured local server address) to confirm that the application runs successfully.</li>
        </ul>
      </li>
    </ol>

    <h4>Troubleshooting Tips</h4>
    <ul>
      <li>Check PHP Extensions: Use <code>php -m</code> to list installed PHP modules and verify required extensions are enabled.</li>
      <li>Review Logs: Any issues encountered should be recorded in the <code>writable/logs</code> directory, where you can review error logs to troubleshoot.</li>
      <li>Verify Database Connection: Double-check <code>.env</code> file database settings and ensure the local database server is running.</li>
    </ul>
  </p>
</details>

