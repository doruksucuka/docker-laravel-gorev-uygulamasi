# Git Rules

## General Rules

### Branch Structure
- **main/master**: Production code, must always be stable
- **develop**: Development branch, new features are merged here
- **feature/**: New feature development branches (`feature/user-login`)
- **hotfix/**: Emergency fixes (`hotfix/critical-bug`)
- **release/**: Release preparation branches (`release/v1.2.0`)

### Commit Messages

#### Format
```
<type>(<scope>): <short description>

<detailed description>

<footer>
```

#### Commit Types
- **feat**: New feature
- **fix**: Bug fix
- **docs**: Documentation changes
- **style**: Code formatting, missing semicolons, etc.
- **refactor**: Code refactoring
- **test**: Adding or fixing tests
- **chore**: Build processes, auxiliary tools, etc.

#### Examples
```
feat(auth): add user authentication system

fix(api): resolve null pointer exception

docs(readme): update installation instructions
```

### Branch Naming Conventions

#### Acceptable Formats
- `feature/JIRA-123-user-profile`
- `bugfix/login-issue-fix`
- `hotfix/critical-security-vulnerability`
- `release/v2.1.0`

#### Rules
- Use lowercase letters
- Use hyphens (-) between words
- No special characters or spaces
- Maximum 50 characters
- Include issue/ticket number when applicable

### Merge and Pull Request Rules

#### Pull Request Process
1. Create feature branch from updated develop
2. Make changes and test thoroughly
3. Create Pull Request
4. Get at least 1 code review approval
5. Ensure CI/CD pipeline passes
6. Merge using appropriate strategy

#### Merge Strategies
- **Feature → Develop**: Squash and merge
- **Develop → Main**: Merge commit
- **Hotfix → Main**: Fast-forward merge



#### Hotfix Process
1. Create hotfix branch from main
2. Fix the issue
3. Test thoroughly
4. Merge to both main and develop
5. Create tag and deploy

#### Rollback Process
1. Identify the issue
2. Determine previous stable commit
3. Create hotfix branch
4. Create revert commit
5. Follow standard hotfix process

### Team Responsibilities

#### Lead Developer
- Code review approvals
- Merge strategy decisions
- Branch protection rules management

#### Developers
- Follow these guidelines
- Participate in code reviews
- Maintain clean commit history


### Best Practices

#### Commit Best Practices
- Make frequent, small commits
- Each commit should represent a logical unit
- Write clear, descriptive commit messages
- Use present tense in commit messages
- Reference issues/tickets when applicable

#### Branch Best Practices
- Keep branches focused and short-lived
- Regularly sync with develop/main
- Delete merged branches
- Use descriptive branch names

#### Collaboration Best Practices
- Communicate changes that affect others
- Coordinate on shared files
- Resolve conflicts promptly
- Keep team informed of blockers

