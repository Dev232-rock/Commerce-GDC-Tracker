
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

## CASE 6 — Must push from repo root
```bash
cd "$(git rev-parse --show-toplevel)"
git add .
git commit -m "Update"
git push
```

## CASE 7 — Empty folder handling
```bash
touch script/.gitkeep
git add script/.gitkeep
git commit -m "Add script folder"
git push
```

## CASE 8 — Add folder from outside repo
```bash
mv /path/to/other-folder ./script
git add script
git commit -m "Add script folder"
git push
```

## CASE 9 — Branch rename
```bash
git branch -M main
git push -u origin main
```

## CASE 10 — SSH authentication
```bash
eval "$(ssh-agent -s)"
ssh-add ~/.ssh/id_ed25519
ssh -T git@github.com
```

