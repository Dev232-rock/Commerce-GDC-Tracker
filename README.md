
# Git Troubleshooting Summary

## CASE 1 — No remote configured
```bash
git remote add origin <url>
git push -u origin main
```

## CASE 2 — Branch/main missing or no commits
```bash
git add .
git commit -m "Initial commit"
git branch -M main
git push -u origin main
```

## CASE 3 — Remote has commits
```bash
git pull origin main --rebase
git push
```

## CASE 4 — Normal push workflow
```bash
git add .
git commit -m "Update"
git push
```

## CASE 5 — Nested .git folder (submodule issue)
```bash
rm -rf script/.git
git add script
git commit -m "Add script folder"
git push
```

# CASE 6 — SSH authentication
```bash
eval "$(ssh-agent -s)"
ssh-add ~/.ssh/id_ed25519
ssh -T git@github.com
```
