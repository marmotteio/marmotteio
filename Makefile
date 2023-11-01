VERSION := $(shell cat VERSION)

git:
	git add -A
	opencommit

bump-version:
	echo $(VERSION) | awk -F. '{print $$1"."$$2"."$$3+1}' > VERSION

build-docker:
	docker build -t marmotteio/marmotteio:$(VERSION) .
	docker tag marmotteio/marmotteio:$(VERSION) marmotteio/marmotteio:latest

push-docker:
	docker push marmotteio/marmotteio:$(VERSION)
	docker push marmotteio/marmotteio:latest

push-tags:
	git tag v$(VERSION)
	git push --tags

github-release:
	gh release create v$(VERSION) --title "Release v$(VERSION)" --notes "Release version v$(VERSION)"

release: git push-tags build-docker push-docker github-release
